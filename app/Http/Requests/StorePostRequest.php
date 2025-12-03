<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|max:4096',
            'images' => 'nullable|array',
            'images.*' => 'image|max:4096',
            'status' => 'required|in:available,unavailable',
            'capacity' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0'
        ];
    }
}
