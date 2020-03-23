<?php

namespace App;

use App\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "description",
        "account_id",
        "deposite_or_withdrawal",
        "total_amount",
        "category",
        "notes",
        "transaction_date",
        "vendor_id",
        "customer_id",
        "tax_id",
        "is_reviewed",
    ];

    protected $casts = [
        "description" => "text",
        "account_id" => "integer",
        "deposite_or_withdrawal" => "string",
        "total_amount" => "double",
        "category" => "string",
        "notes" => "text",
        "transaction_date" => "date",
        "vendor_id" => "integer",
        "customer_id" => "integer",
        "tax_id" => "integer",
        "is_reviewed" => "boolean",
    ];

    //Relationship
    public function account()
    {
        $this->belongsTo(Account::class);
    }

    public function tax()
    {
        $this->belongsTo(Tax::class);
    }

    public static function validationRules($id = null)
    {
        return [
            "description" => ["required"],
            "account_id" => ["required", "exists:accounts,id"],
            "deposite_or_withdrawal" => ["required", "in:Deposite,Withdrawal"],
            "total_amount" => ["required", "numeric"],
            "category" => ["required"],
            "transaction_date" => ["required", "date"],
            "vendor_id" => ["integer"],
            "customer_id" => ["integer"],
            "tax_id" => ["exists:taxes,id", "integer"],
            "is_reviewed" => ["boolean"],
        ];
    }
    //Store
    public static function store($request, $transaction = null)
    {
        if (is_null($transaction)) {
            $transaction = new Transaction();
        }

        $transaction->fill($request->all())->save();
    }

    //Update
    public function updateTransaction($request)
    {
        self::store($request, $this);
    }
}
