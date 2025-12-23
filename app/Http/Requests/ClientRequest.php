<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name'      => [$isUpdate ? 'sometimes' : 'required'],
            'email'     => [$isUpdate ? 'sometimes' : 'required'],
            'phone'     => [$isUpdate ? 'sometimes' : 'required'],
            'city'      => [$isUpdate ? 'sometimes' : 'nullable'],
            'note'      => [$isUpdate ? 'sometimes' : 'nullable'],
            'source_id' => [$isUpdate ? 'sometimes' : 'nullable'],
            'status'    => [$isUpdate ? 'sometimes' : 'nullable'],
        ];
    }
}
