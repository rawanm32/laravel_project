<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true; 
    }


    public function rules(): array
    {
    
        $bookId = $this->route('book'); 

        return [
        
            'title' => ['required', 'string', 'max:255', Rule::unique('books', 'title')->ignore($bookId)],
            
     
            'category_id' => 'required|exists:categories,id', 
            'author_id' => 'required|exists:authors,id', 
            
        
            'description' => 'nullable|string',
            'pages' => 'nullable|integer|min:1',
            'publication_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            
          
            'price' => 'required|numeric|min:0', 
            'compare_price' => 'nullable|numeric|min:0|gt:price', 
            
          
            'image' => [
    Rule::when($this->hasFile('image'), ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']),
    'nullable',
],
            
         
            'status' => ['required', 'string', Rule::in(['available', 'unavailable'])],
        ];
    }
}