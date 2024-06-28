<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class TaskRequest extends FormRequest
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
            'title' => "{$this->requiredRule()}|string|min:1|max:64",
            'description' => "{$this->requiredRule()}|string|min:1|max:128",
            'due_date' => "{$this->requiredRule()}|date_format:Y-m-d H:i:s",
            'status' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'string' => 'Атрибут :attribute должен быть строкой',
            'title.min' => 'Атрибут :attribute должен содержать миниму :min символов',
            'title.max' => 'Атрибут :attribute может содержать максиму :max символов',
            'required' => 'Атрибут :attribute обязателен для заполнения',
            'due_date.date_format' => 'Атрибут :attribute должен соответствовать формату Y-m-d H:i:s',
            'status.boolean' => 'Атрибут :attribute должен быть булевым значением (true или false)'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $response = response()->json([
            'errors' => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }

    protected function requiredRule(): \Illuminate\Validation\Rules\RequiredIf
    {
        return new RequiredIf(function () {
            return $this->isMethod('post');
        });
    }
}
