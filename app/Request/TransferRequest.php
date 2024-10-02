<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class TransferRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'payer' =>'required|exists:users,id|different:payee',
            'payee' =>'required|exists:users,id|different:payer',
            'amount' =>'required|min:1',
        ];
    }
}
