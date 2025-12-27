<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * عرض الصفحة الرئيسية مع نتائج البحث (فلترة الكتب).
     */
 function index(Request $request)
{
    $search = $request->input('search');

    // بدء بناء الاستعلام
    $booksQuery = Book::query();

    if ($search) {
        // تطبيق شرط البحث (اسم الكتاب أو اسم المؤلف)
        $booksQuery->where(function ($q) use ($search) {
            
            // البحث في عمود 'title' (على افتراض أن هذا هو اسم عمود الكتاب)
            $q->where('title', 'LIKE', "%{$search}%");
            
            // البحث في اسم المؤلف المرتبط
            $q->orWhereHas('author', function ($authorQuery) use ($search) {
                $authorQuery->where('name', 'LIKE', "%{$search}%");
            });
        });
    }

    // إكمال الاستعلام وتنفيذه مع pagination
    $books = $booksQuery->with('author', 'category')
                        ->where('status', 'available') // ← أضف هذا إذا بدك بس الكتب النشطة
                        ->orderBy('created_at', 'desc')
                        ->paginate(12); // ← غير get() إلى paginate(12)

    return view("home", compact('books'));
}
    
    /**
     * عرض تفاصيل كتاب محدد وجلب الكتب ذات الصلة.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function show(Book $book) 
    {
        // 1. التحقق من حالة الكتاب.
        // بما أنكِ اختبرتِ الـ 403 بنجاح، نعود لاستخدام الـ 404 لإخفاء الكتاب
        if ($book->status !== 'available') {
            abort(404);
        }
        
        $book->load('category', 'author');

        // جلب الكتب ذات الصلة
        $relatedBooks = Book::with('category', 'author')
            ->where('status', 'active')
            ->where('id', '!=', $book->id)
            ->get();

       
        if ($relatedBooks->count() < 4) {
            $limit = 4 - $relatedBooks->count();

            $additionalBooks = Book::with('category', 'author')
                ->where('status', 'available')
                ->where('id', '!=', $book->id)
                ->whereNotIn('id', $relatedBooks->pluck('id'))
                ->inRandomOrder()
                ->limit($limit)
                ->get();
            
            $relatedBooks = $relatedBooks->merge($additionalBooks);
        }

        return view("books_show", compact('book','relatedBooks'));
    } 
}