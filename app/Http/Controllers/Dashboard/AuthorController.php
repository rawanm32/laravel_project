<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class AuthorController extends Controller
{
 
       public function index(){
   Gate::authorize('authors.view');
    $request = request();
    $query = Author::query();
    $name = $request->query('name');
    $status = $request->query('status');
    $query = Author::query()->withCount('books');

    if ($name) {
    
        $query->where('name', 'LIKE', "%{$name}%");
    }

    if ($status) {
        $query->where('status', '=', $status);
    }

 
    $authors = $query
    ->paginate(5); 

    $totally = Author::paginate()->count();
    return view('dashboard.pages.authors.index', [
        'authors' => $authors,
        'totally' => $totally,
      
    ]); 
    }
  
    public function create()
    {
    Gate::authorize('authors.create');
        $author = new Author();
        return view('dashboard.pages.authors.create', compact('author'));
    }



    public function store(Request $request)
    {
  
        $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string',
            'status' => ['required', 'string', \Illuminate\Validation\Rule::in(['active', 'inactive'])],
        ]);

  
    
        $author = Author::create($request->all());
        return redirect()
            ->route('dashboard.authors.index')
            ->with('success', 'تم إضافة المؤلف بنجاح!');
    }
    public function edit(Author $author)
    {
        Gate::authorize('authors.edit');
    
        return view('dashboard.pages.authors.edit', compact('author'));
    }

  
    public function update(Request $request, Author $author)
    {       $request->validate([
          
            'name' => 'required|string|max:100|unique:authors,name,' . $author->id,
            'bio' => 'nullable|string',
            'status' => ['required', 'string', Rule::in(['active', 'inactive'])],
        
        ]);

    

        $author->update($request->all());
        return redirect()
            ->route('dashboard.authors.index')
            ->with('success', 'تم تحديث بيانات المؤلف بنجاح!');
    }

  
    public function destroy(Author $author)
    {
        Gate::authorize('authors.destroy');
        $author->delete();

        return redirect()
            ->route('dashboard.authors.index')
            ->with('success', 'تم حذف المؤلف بنجاح!');
    }

    public function show(Author $author){
        // Gate::authorize('authors.view');
    
  
    $books = $author->books;
    
    return view('dashboard.pages.authors.show', compact('author', 'books'));
    }
}