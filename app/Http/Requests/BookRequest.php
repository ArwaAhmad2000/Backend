<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => "required|string|min:3|max:50|unique:books,title",
            'image' => "required|image|mimes:png,jpg,jpeg",
            'description' => "required|string|min:5",
            'slug' => "required|string|min:5|max:20",
            'ibsn' => "required|string|min:5|max:20",
            'publish_year' => "required|string",
            'rate' => "required|integer|min:1|max:5",
            'book' => "required|file",
            'author_id' => "required|integer",
            'category_id' => "required|integer",
        ];
    }
}
