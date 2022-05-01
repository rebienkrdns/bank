<?php

namespace App\Providers;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AccountsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function listOwnAccounts()
    {
        return Account::select(
            "id",
            "account",
            "status",
            DB::raw("(SELECT value FROM transactions WHERE account_id_origin = accounts.id ORDER BY transactions.id DESC LIMIT 1) as value")
        )->where("user_id", Auth::user()->id)->get();
    }

    public static function listOwnActiveAccounts()
    {
        return Account::select(
            "id",
        )->where([
            ["user_id", Auth::user()->id],
            ["status", "active"]
        ])->count() == 1;
    }

    public static function listThirdPartyAccounts()
    {
        return Account::select(
            "id",
            "account",
            "status",
            DB::raw("(SELECT value FROM transactions WHERE account_id_origin = accounts.id ORDER BY transactions.id DESC LIMIT 1) as value")
        )->where("user_id", "!=", Auth::user()->id)->get();
    }

    public static function listThirdPartyActiveAccounts()
    {
        return Account::select(
            "id",
        )->where([
            ["user_id", "!=", Auth::user()->id],
            ["status", "active"]
        ])->count() == 0;
    }

    public static function isValidAndEnabledAccount($account)
    {
        return Account::where([
            ["id", $account],
            ["user_id", Auth::user()->id],
            ["status", "active"]
        ])->exists();
    }
}
