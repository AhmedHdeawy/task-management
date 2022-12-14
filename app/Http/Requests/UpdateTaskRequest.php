<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            "name"          =>  "required|min:2|max:200",
            "project_id"    =>  "required|numeric|exists:projects,id",
            "priority"      =>  "nullable|numeric|min:1"
        ];
    }
}
