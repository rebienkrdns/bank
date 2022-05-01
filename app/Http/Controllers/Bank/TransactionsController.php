<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Http\Requests\ownTransactionRequest;
use App\Http\Requests\thirdPartyTransactionRequest;
use App\Providers\AccountsServiceProvider;
use App\Providers\TransactionsServiceProvider;

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = TransactionsServiceProvider::all();
        
        return view('bank.transactions')
        ->with("transactions", $transactions);
    }

    public function ownTransactions()
    {
        $ownAccounts = AccountsServiceProvider::listOwnAccounts();
        $insufficientOwnAccounts = AccountsServiceProvider::listOwnActiveAccounts();

        return view('bank.transactions.own')
            ->with("ownAccounts", $ownAccounts)
            ->with("insufficientOwnAccounts", $insufficientOwnAccounts);
    }

    public function thirdPartyTransactions()
    {
        $ownAccounts = AccountsServiceProvider::listOwnAccounts();
        $insufficientOwnAccounts = AccountsServiceProvider::listOwnActiveAccounts();
        
        $thirdPartyAccounts = AccountsServiceProvider::listThirdPartyAccounts();
        $insufficientThirdPartyAccounts = AccountsServiceProvider::listThirdPartyActiveAccounts();

        return view('bank.transactions.third-party')
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

    public function thirdPartyAccountTransaction(thirdPartyTransactionRequest $request)
    {
        $transactionCode = $request->createThirdPartyTransaction();

        $request->session()->flash('feedback', trans('transactions.success') . $transactionCode);

        return redirect()->back();
    }
}
