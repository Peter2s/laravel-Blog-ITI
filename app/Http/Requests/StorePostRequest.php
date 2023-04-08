<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            "title" => 'required|min:3|max:255|unique:posts,title',
            "description" =>'required|min:10|max:255',
            'user_id'=>'required|exists:users,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',


        ];
    }
        public function messages():array{
            return [
                'title.required' => 'Post Title is Required',
                'title.unique' => 'Post Title Already exists',
                'title.min' => 'Title must be more than 3 characters',
                'description.required' => 'Post Description is required',
                'description.min' => 'Description Must be more than 10 character',
                'description.max' => 'Description cannot exceed 225 character',
                'user_id.required' => 'Select User',
                'user_id..exists' => 'Invalid User ID',
                'image.required' => 'Select Image',
                'image.mimes' => 'Image must be a [ jpeg , png , jpg , gif ] file',
        
            ];
        }
    }

