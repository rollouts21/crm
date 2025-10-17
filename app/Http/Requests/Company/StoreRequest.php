<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string',
            'phone' => ['required', 'regex:/^(\+7|8)[\s\(\-]*\d{3}[\s\)\-]*\d{3}[\s\-\/]*\d{2}[\s\-\/]*\d{2}$/', 'unique:companies,phone'],
            'address' => 'required|string',
            'source' => 'required|string',
            'status' => 'required|string',
            'worktime' => 'required|string',
            'description' => 'required|string',
            'etc' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            "*.required" => 'Это поле обязательно для заполнения',
            "*.string" => 'Поле должно быть строкой',
            'phone.regex' => 'Номер телефона должен быть в формате +7 или 8',
            'phone.unique' => "Компания с таким номером телефона уже существует!"
        ];
    }
}
