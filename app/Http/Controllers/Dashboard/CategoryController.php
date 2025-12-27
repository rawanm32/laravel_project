<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryRequest;
class CategoryController extends Controller
{
 
   public function index()
{  
    Gate::authorize('categories.view');
    $request = request();
    
    // ابدأ بالـ query مع withCount مباشرة
    $query = Category::query()->withCount('books');
    
    $name = $request->query('name');
    $status = $request->query('status');

    if ($name) {
        $query->where('name', 'LIKE', "%{$name}%");
    }

    if ($status) {
        $query->where('status', '=', $status);
    }

    $categories = $query->paginate(5);
    $totally = Category::count(); // استخدم count() بدل paginate()->count()

    return view('dashboard.pages.categories.index', [
        'categories' => $categories,
        'totally' => $totally,
    ]); 
    }

        public function create()
    {
           Gate::authorize('categories.create');
    $category = new Category();
        return view('dashboard.pages.categories.create',[
            'category'=>$category
        ]); 
    }
    public function store(CategoryRequest $request)
    {
       
       $category = new Category();
    $category->name = $request->name_en ?? $request->name_ar; // Use first available
    $category->status = $request->status;
    $category->slug = Str::slug($request->name_en ?? $request->name_ar);
    $category->description = $request->description_en ?? $request->description_ar;
    $category->save();
    
    
    
    $locales = config('app.available_locales', ['en', 'ar']);
    foreach ($locales as $locale) {
        $translations = [
            'name' => $request->input("name_{$locale}"),
            'description' => $request->input("description_{$locale}")
        ];
        
     
        if ($translations['name'] || $translations['description']) {
            $category->saveTranslations($translations, $locale);
        }
    }
    
        return redirect()->route('dashboard.categories.index')->with('success', 'تم إضافة التصنيف بنجاح!');
    }

  public function edit($id)
    {
        Gate::authorize('categories.update');
        $parents = Category::all();
        $category = Category::findOrFail($id);
        
        return view('dashboard.pages.categories.edit', [
            'category' => $category,
            'parents' => $parents
        ]);
    }

public function update(CategoryRequest $request, $id)
{
    $category = Category::findOrFail($id);
    $category->name = $request->name_en ?? $request->name_ar;
    $category->parent_id = $request->parent_id;
    $category->status = $request->status;
    $category->slug = Str::slug($request->name_en ?? $request->name_ar);
    $category->description = $request->description_en ?? $request->description_ar;
    $category->save();
    
    
    $locales = config('app.available_locales', ['en', 'ar']);
    foreach ($locales as $locale) {
        $translations = [
            'name' => $request->input("name_{$locale}"),
            'description' => $request->input("description_{$locale}")
        ];
        
        if ($translations['name'] || $translations['description']) {
            $category->saveTranslations($translations, $locale);
        }
    }
    
    return redirect()
        ->route('categories.index')
        ->with('warning', 'Category updated successfully');
}


    public function destroy(Category $category) 
    {
           Gate::authorize('categories.delete');
        $category->delete();
        
        return redirect()->route('dashboard.categories.index')->with('success', 'تم حذف التصنيف بنجاح!');
    }
    public function show(Category $category)
{
    // Gate::authorize('categories.view'); // تأكد من الـ Gate الصحيح
    
    $books = $category->books;
    
    return view('dashboard.pages.categories.show', compact('category', 'books')); // 'category' ليس 'cateory'
}
}