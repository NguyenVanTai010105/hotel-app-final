<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check(); // thay logic nếu chỉ admin được phép
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:4096',
            'status' => ['required', Rule::in(['draft','published'])],
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
        ];
    }

    protected function prepareForValidation()
    {
        if (!$this->filled('slug') && $this->filled('title')) {
            $this->merge(['slug' => \Illuminate\Support\Str::slug($this->title)]);
        }
    }
}
