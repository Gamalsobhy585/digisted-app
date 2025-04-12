<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SwapOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); 
    }

    public function rules(): array
    {
        return [
            'first_task_id' => 'required|exists:tasks,id',
            'second_task_id' => 'required|exists:tasks,id',
        ];
    }

    public function messages(): array
    {
        return [
            'first_task_id.required' => __('validation.task_first_task_id_required'),
            'first_task_id.exists' => __('validation.task_first_task_id_exists'),
            'second_task_id.required' => __('validation.task_second_task_id_required'),
            'second_task_id.exists' => __('validation.task_second_task_id_exists'),
        ];
    }
}