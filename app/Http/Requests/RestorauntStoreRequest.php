<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestorauntStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:64',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string|max:500',
            'instagram' => ['nullable', 'string', 'max:256', 'regex:/^(https?:\/\/)?(www\.)?(instagram\.com)\/[A-Za-z0-9_.-]+\/?$/'],
            'youtube' => ['nullable', 'string', 'max:256', 'regex:/^(https?:\/\/)?(www\.)?(youtube\.com\/|youtu\.be\/)/'],
            'phone_number' => 'nullable|string|max:64',
            'address' => 'required|max:255'
        ];
    }
}
