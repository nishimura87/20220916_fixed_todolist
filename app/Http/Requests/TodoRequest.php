<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'task_name' => 'required|max:20',
            'tag_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'task_name.required' => 'タスクを入力してください。',
            'task_name.max' => 'タスクは20文字以内で入力してください。',
        ];
    }
}
