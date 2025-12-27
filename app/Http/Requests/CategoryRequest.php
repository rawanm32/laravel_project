<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->user()->super_admin) {
            return true;
        }
        return Gate::allows('categories.create') || Gate::allows('categories.update')||Gate::allows('categories.delete')||Gate::allows('categories.view');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
  public function rules(): array
{
    $locales = config('app.available_locales', ['en', 'ar']);
    $rules = [];

    foreach ($locales as $locale) {
       
        $otherLocale = ($locale === 'en') ? 'ar' : 'en';

        $rules["name_{$locale}"] = [
            "required_without:name_{$otherLocale}", 
            "nullable",                            
            "string", 
            "min:2", 
            "max:255"
        ];

        $rules["description_{$locale}"] = 'nullable|string';
    }


    $rules['status'] = 'required|in:active,inactive';

    return $rules;
}

    /**
     * Get custom messages for validator errors.
     */
    public function messages()
    {
        return [
            'name_en.required_without' => 'يجب إضافة الاسم باللغة الإنجليزية أو العربية على الأقل',
            'name_en.min' => 'الاسم بالإنجليزية يجب أن يكون على الأقل حرفين',
            'name_ar.required_without' => 'يجب إضافة الاسم باللغة العربية أو الإنجليزية على الأقل',
            'name_ar.min' => 'الاسم بالعربية يجب أن يكون على الأقل حرفين',
            'description_en.required' => 'الوصف بالإنجليزية مطلوب',
            'description_ar.required' => 'الوصف بالعربية مطلوب',
            'status.required' => 'حالة الفئة مطلوبة',
            'status.in' => 'حالة الفئة يجب أن تكون نشط أو غير نشط',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes()
    {
        return [
            'name_en' => 'الاسم (EN)',
            'name_ar' => 'الاسم (AR)',
            'description_en' => 'الوصف (EN)',
            'description_ar' => 'الوصف (AR)',
            'status' => 'الحالة',
        ];
    }
}