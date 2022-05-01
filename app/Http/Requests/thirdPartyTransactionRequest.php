<?php

namespace App\Http\Requests;

use App\Providers\AccountsServiceProvider;
use App\Providers\TransactionsServiceProvider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class thirdPartyTransactionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'account_origin' => ['required', 'numeric'],
            'account_destination' => ['required', 'numeric'],
            'transaction' => ['required', 'numeric']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'account_origin.required' => 'La cuenta de origen es obligatoria',
            'account_origin.numeric' => 'La cuenta de origen debe ser numérica',
            'account_destination.required' => 'La cuenta de destino es obligatoria',
            'account_destination.numeric' => 'La cuenta de destino debe ser numérica',
            'transaction.required' => 'El monto es obligatorio',
            'transaction.numeric' => 'El monto debe ser numérico',
        ];
    }

    public function createThirdPartyTransaction()
    {
        $data = $this->only('account_origin', 'account_destination', 'transaction');

        if (!AccountsServiceProvider::isValidAndEnabledOwnAccount($data["account_origin"])) {
            throw ValidationException::withMessages([
                'message' => trans('transactions.account_origin.failed'),
            ]);
        }

        if (!AccountsServiceProvider::isValidAndEnabledThirdPartyAccount($data["account_destination"])) {
            throw ValidationException::withMessages([
                'message' => trans('transactions.account_destination.failed'),
            ]);
        }

        if ($data["transaction"] <= 0) {
            throw ValidationException::withMessages([
                'message' => trans('transactions.invalid_value'),
            ]);
        }

        if (!TransactionsServiceProvider::validateSufficientBalance($data["account_origin"], $data["transaction"])) {
            throw ValidationException::withMessages([
                'message' => trans('transactions.insufficient_funds'),
            ]);
        }

        return TransactionsServiceProvider::createNew($data);
    }
}
