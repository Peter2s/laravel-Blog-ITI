<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required|min:3|unique:posts,title,' . $this->id,
            'description' => 'required|min:10|max:225',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

          
        ];
    }
    public function messages():array{
        return [
            'title.required' => 'Title is required',
            'title.min' => 'Title must be at least 3 characters',
            'title.unique' => 'Title has already been taken',
            'description.required' => 'Description is required',
            'description.min' => 'Description must be at least 10 characters',
            'description.max' => 'Description cannot be more than 225 characters',
            'image.required' => 'Select Image',
            'image.mimes' => 'Image must be a [ jpeg , png , jpg , gif ] file',
        ];
    }
}
