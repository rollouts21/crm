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
        return [
            'title'             => 'required',
            'amount'            => 'required',
            'status'            => 'required',
            'expected_close_at' => 'required',
            'closed_at'         => 'nullable',
            'lost_reason'       => 'nullable',
            'comment'           => 'required',
        ];
    }
}
