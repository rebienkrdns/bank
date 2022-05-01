<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        "account_id_origin",
        "account_id_destination",
        "transaction",
        "value",
        "created_at"
    ];
}
