<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Book::with(['author', 'category'])->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
      $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            // أصبح nullable لأنه سيتم توليده هنا
            'slug' => 'nullable|string|unique:books,slug|max:255',
            'description' => 'nullable|string',
            'compare_price'=>'nullable|numeric|min:0',
            'pages' => 'nullable|integer|min:1',
            'publication_year' => 'nullable|integer|max:' . date('Y'),
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'author_id' => 'nullable|exists:authors,id',
            
            // 💡 الإضافة المفقودة: قاعدة التحقق من ملف الصورة
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB كحد أقصى
        ]);

      
        $slug = Str::slug($validatedData['title']);
        $validatedData['slug'] = $slug;

   
        $imagePath = $this->processImage($request); 
        
       
        $bookData = array_merge($validatedData, [
    
            'user_id' => Auth::id(), 
            'slug' => $slug,
            'image' => $imagePath, 
        ]);


        $book = Book::create($bookData);
        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
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
