<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Account extends Model
{
    protected $fillable = [
        "account_category_id",
        "parent_id",
        "tax_id",
        "name",
        "description",
        "balance",
        "balance_as_of",
        "unpaid_balance",
        "unpaid_balance_as_of",
        "is_sub_account",
    ];

    protected $casts = [
        "account_category_id" => "integer",
        "parent_id" => "integer",
        "tax_id" => "integer",
        "name" => "string",
        "description" => "text",
        "balance" => "double",
        "balance_as_of" => "datetime",
        "unpaid_balance" => "double",
        "unpaid_balance_as_of" => "datetime",
        "is_sub_account" => "boolean",
    ];

    //Relationships
    public function accountCategory()
    {
        $this->belongsTo(AccountCategory::class);
    }

    public static function validationRules($id = null)
    {
        if (!is_null($id)) {
            $ignore = ",$id";
        } else {
            $ignore = "";
        }

        return [
            "account_category_id" => ["required", "integer", "exists:account_categories,id"],
            "parent_id" => ["integer", "exists:account_categories,id", Rule::requiredIf(request()->is_sub_account === true)],
            "tax_id" => ["integer"],
            "name" => ["required", "unique:accounts,name" . "$ignore"],
            "is_sub_account" => ["boolean"],
        ];
    }

    //Store
    public static function store($request, $account = null)
    {
        if (is_null($account)) {
            $account = new Account();
        }

        $account->fill($request->all())->save();
    }

    //Update account
    public function updateAccount($request)
    {
        self::store($request, $this);
    }
}
