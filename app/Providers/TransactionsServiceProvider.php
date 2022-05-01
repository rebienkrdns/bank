<?php

namespace App\Providers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class TransactionsServiceProvider extends ServiceProvider
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

    public static function validateSufficientBalance($account_id_origin, $value)
    {
        return Transaction::where([
            ["account_id_origin", $account_id_origin],
            ["value", ">=", $value]
        ])
            ->orderBy("id", "DESC")
            ->limit(1)
            ->exists();
    }

    public static function createNew($data)
    {
        $findOriginBalance = Transaction::select("value")
            ->where([
                ["account_id_origin", $data["account_origin"]]
            ])
            ->orderBy("id", "DESC")
            ->limit(1)
            ->first();

        $lastOriginBalance = is_null($findOriginBalance) ? 0 : $findOriginBalance->value;

        Transaction::create([
            "account_id_origin" => $data["account_origin"],
            "account_id_destination" => $data["account_destination"],
            "transaction" => $data["transaction"],
            "value" => $lastOriginBalance - $data["transaction"],
            "created_at" => Carbon::now()
        ]);

        $findDestinationBalance = Transaction::select("value")
            ->where([
                ["account_id_origin", $data["account_destination"]]
            ])
            ->orderBy("id", "DESC")
            ->limit(1)
            ->first();

        $lastDestinationBalance = is_null($findDestinationBalance) ? 0 : $findDestinationBalance->value;

        $destinationTransaction = Transaction::create([
            "account_id_origin" => $data["account_destination"],
            "account_id_destination" => null,
            "transaction" => $data["transaction"],
            "value" => $lastDestinationBalance + $data["transaction"],
            "created_at" => Carbon::now()
        ]);

        $code = str_pad($destinationTransaction->id, 5, "0", STR_PAD_LEFT);

        return $code;
    }

    public static function all()
    {
        return Transaction::select(
            "transactions.id",
            DB::raw("(SELECT account FROM accounts WHERE accounts.id = account_id_origin) as origin"),
            DB::raw("(SELECT account FROM accounts WHERE accounts.id = account_id_destination) as destination"),
            "value"
        )->get();
    }
}
