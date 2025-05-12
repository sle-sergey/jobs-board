<?php

namespace App\Http\Requests;

use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|min:3',
            'location' => 'required|string|max:255|min:3',
            'salary' => 'required|numeric|min:5000|max:1700000',
            'description' => 'required|string|min:10',
            'category' => 'required|in:' . implode(',', Job::$category),
            'experience' => 'required|in:' . implode(',', Job::$experience),
        ];
    }
}
