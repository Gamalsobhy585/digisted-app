<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ];
    }

    public function messages()
    {
        return [
            'file.required' =>__('messages.validation.file_required'),
            'file.file' => __('messages.validation.file_type'),
            'file.mimes' => __('messages.validation.file_mimes'),
        ];
    }
}