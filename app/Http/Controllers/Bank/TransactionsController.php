<?php

namespace App\Http\Controllers\Bank;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\ownTransactionRequest;
use App\Models\Transaction;
use App\Providers\AccountsServiceProvider;

class TransactionsController extends Controller
{
    public function index()
    {
        /* Own accounts */
        $ownAccounts = AccountsServiceProvider::listOwnAccounts();
        $insufficientOwnAccounts = AccountsServiceProvider::listOwnActiveAccounts();
        /* End Own Accounts */

        /* Third Party accounts */
        $thirdPartyAccounts = AccountsServiceProvider::listThirdPartyAccounts();
        $insufficientThirdPartyAccounts = AccountsServiceProvider::listThirdPartyActiveAccounts();
        /* End Third Party Accounts */

        return view('bank.transactions')
            ->with("ownAccounts", $ownAccounts)
            ->with("insufficientOwnAccounts", $insufficientOwnAccounts)
            ->with("thirdPartyAccounts", $thirdPartyAccounts)
            ->with("insufficientThirdPartyAccounts", $insufficientThirdPartyAccounts);
    }

    public function ownAccountTransaction(ownTransactionRequest $request)
    {
        $transactionCode = $request->createOwnTransaction();

        $request->session()->flash('feedback', trans('transactions.success') . $transactionCode);

        return redirect()->back();
    }
}
