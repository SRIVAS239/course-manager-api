<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'teacher';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_name' => 'required|string|max:255',
            'course_desc' => 'nullable|string',
            'is_active' => 'boolean',
            'chapters' => 'nullable|array',
            'chapters.*.title' => 'required_with:chapters|string|max:255',
            'chapters.*.description' => 'nullable|string',
            'chapters.*.is_locked' => 'boolean',
            'chapters.*.is_preview' => 'boolean',
        ];
    }
}
