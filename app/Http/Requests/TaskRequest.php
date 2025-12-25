<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

        $isUpdate = $this->isMethod('patch') || $this->isMethod('put');

        return [
            'title'       => $isUpdate ? ['sometimes', 'string', 'max:255'] : ['required', 'string', 'max:255'],
            'description' => $isUpdate ? ['sometimes', 'nullable', 'string'] : ['nullable', 'string'],
            'status'      => $isUpdate ? ['sometimes', 'string', 'in:open,done,canceled'] : ['required', 'string', 'in:open,done,canceled'],
            'priority'    => $isUpdate ? ['sometimes', 'string', 'in:high,normal,low'] : ['required', 'string', 'in:high,normal,low'],
            'due_at'      => $isUpdate ? ['sometimes', 'date'] : ['required', 'date'],
        ];

    }
}
