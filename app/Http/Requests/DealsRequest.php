<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealsRequest extends FormRequest
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
        $isUpdate = $this->isMethod('patch' || $this->isMethod('put'));
        return [
            'title'             => [$isUpdate ? 'sometimes' : 'required'],
            'amount'            => [$isUpdate ? 'sometimes' : 'required'],
            'status'            => [$isUpdate ? 'sometimes' : 'required'],
            'expected_close_at' => [$isUpdate ? 'sometimes' : 'required'],
            'closed_at'         => [$isUpdate ? 'sometimes' : 'nullable'],
            'lost_reason'       => [$isUpdate ? 'sometimes' : 'nullable'],
            'comment'           => [$isUpdate ? 'sometimes' : 'required'],
        ];
    }
}
