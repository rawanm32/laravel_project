<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\BookRequest; 

class BookController extends Controller
{
    /**
     * عرض قائمة الكتب.
     */
    public function index(Request $request)
    {
           Gate::authorize('books.view');
       
        // عرض جميع الكتب مع العلاقات، والتصفح (Pagination) أفضل من get()
        $books = Book::with(['author', 'category'])
                ->when($request->name, function ($query, $value) {
                $query->where('books.title', 'LIKE', "%{$value}%"); }) 
                ->when($request->status, function ($query, $value) {
                $query->where('books.status', '=', $value);})
                ->orderBy('created_at', 'desc')->paginate(15)
                ; 
        
        return view('dashboard.pages.books.index', compact('books'));
    }

    /**
     * عرض نموذج إنشاء كتاب جديد.
     */
    public function create()
    {
        Gate::authorize('books.create');
        // جلب المؤلفين والتصنيفات النشطة
        $authors = Author::where('status', 'active')->pluck('name', 'id');
        $categories = Category::where('status', 'active')->pluck('name', 'id');
        
        $book = new Book();
        return view('dashboard.pages.books.create', compact('book', 'authors', 'categories'));
    }

    /**
     * تخزين كتاب جديد.
     * 💡 تم استخدام BookRequest لفصل قواعد التحقق.
     */
       public function store(Request $request)
    {
        // 1. التحقق من صحة البيانات المرسلة من النموذج
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            // أصبح nullable لأنه سيتم توليده هنا
            'slug' => 'nullable|string|unique:books,slug|max:255',
            'description' => 'nullable|string',
            'book_url' => 'nullable|url',
            'compare_price'=>'required|numeric|min:0',
            'pages' => 'required|integer|min:1',
            'publication_year' => 'required|integer|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            
            // 💡 الإضافة المفقودة: قاعدة التحقق من ملف الصورة
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB كحد أقصى
        ]);

        // 2. توليد الـ Slug تلقائياً من العنوان
        $slug = Str::slug($validatedData['title']);
        $validatedData['slug'] = $slug;

        // 💡 النقص الأساسي هنا: معالجة وحفظ ملف الصورة الجديدة
        $imagePath = $this->processImage($request); // لا يوجد مسار قديم في حالة الإنشاء
        
        // 3. دمج معرّف المستخدم الموثّق والـ Slug ومسار الصورة مع البيانات
        $bookData = array_merge($validatedData, [
            // استخدام Auth::id() لحل مشكلة 'Undefined method id'
            'user_id' => Auth::id(), 
            'slug' => $slug,
            'image' => $imagePath, // إضافة مسار الصورة
        ]);

        // 4. إنشاء الكتاب وحفظه في قاعدة البيانات
        $book = Book::create($bookData);

        // 5. إعادة التوجيه مع رسالة نجاح
        return redirect()->route('dashboard.books.index')->with('success', 'تم إنشاء الكتاب بنجاح وتم ربطه بحسابك.');
    }

    /**
     * عرض نموذج تعديل كتاب.
     */
    public function edit(Book $book)
    {
        Gate::authorize('books.edit');
        // جلب المؤلفين والتصنيفات النشطة
        $authors = Author::where('status', 'active')->pluck('name', 'id');
        $categories = Category::where('status', 'active')->pluck('name', 'id');

        return view('dashboard.pages.books.edit', compact('book', 'authors', 'categories'));
    }

    /**
     * تحديث كتاب موجود.
     * 💡 تم استخدام BookRequest لفصل قواعد التحقق.
     */
    public function update(BookRequest $request, Book $book)
    {
        // 1. البيانات التي يتم إرسالها (بدون ملف الصورة مؤقتاً)
        $data = $request->except('image');
        $data['slug'] = Str::slug($data['title']);

        // 2. معالجة وتحديث ملف الصورة باستخدام الدالة المساعدة
        if ($request->hasFile('image')) {
            // يتم رفع الملف الجديد وحذف القديم داخلياً
            $data['image'] = $this->processImage($request, $book->image);
        } else {
            // إذا لم يتم رفع صورة جديدة، نحتفظ بالصورة القديمة
            $data['image'] = $book->image;
        }

        // 3. تحديث الكتاب
        $book->update($data);

        return redirect()
            ->route('dashboard.books.index')
            ->with('success', 'تم تحديث بيانات الكتاب بنجاح!');
    }

    /**
     * حذف كتاب.
     */
    public function destroy(Book $book)
    {
        Gate::authorize('books.destroy');
        // 💡 يجب حذف الصورة قبل حذف السجل من قاعدة البيانات
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()
            ->route('dashboard.books.index')
            ->with('success', 'تم حذف الكتاب والصورة المرتبطة به بنجاح!');
    }
    
    // =========================================================================
    // 💡 دالة معالجة الصورة (Helper Method) - لتحقيق الكود النظيف
    // =========================================================================

    /**
     * رفع ملف الصورة الجديد وحذف الملف القديم إذا لزم الأمر.
     *
     * @param Request $request
     * @param string|null $oldImage المسار القديم للصورة (في حالة التحديث)
     * @return string|null المسار الجديد للصورة أو null
     */
    private function processImage(Request $request, ?string $oldImage = null): ?string
    {
        if ($request->hasFile('image')) {
            // حفظ الملف الجديد في مجلد 'images/books' داخل 'public' disk
            $newImagePath = $request->file('image')->store('images/books', [
                'disk' => 'public'
            ]);

            // حذف الملف القديم إذا تم تمريره
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            } 
            
            return $newImagePath;
        }

        // إذا لم يتم إرسال ملف، نرجع المسار القديم في حالة التحديث، أو null في حالة الإنشاء
        return $oldImage ?? null; 
    }
}