<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountCategory extends Model
{

    protected $fillable = [
        "parent_id",
        "name",
        "description",
        "is_balance_required",
        "is_balance_date_required",
        "is_unpaid_balance_required",
        "is_unpaid_balance_date_required",
        "create_account",
    ];

    protected $casts = [
        "parent_id" => "integer",
        "name" => "string",
        "description" => "text",
        "is_balance_required" => "boolean",
        "is_balance_date_required" => "boolean",
        "is_unpaid_balance_required" => "boolean",
        "is_unpaid_balance_date_required" => "boolean",
        "create_account" => "boolean",
    ];

    //Validation rules
    public static function validationRules($id = null)
    {
        if (!is_null($id)) {
            $ignore = ",$id";
        } else {
            $ignore = "";
        }

        $rules = [
            "parent_id" => ["sometimes", "nullable", "exists:account_categories,id"],
            "name" => ["required", "unique:account_categories,name" . "$ignore"],
        ];

        return $rules;
    }

    //Store
    public static function store($request, $account_category = null)
    {
        if (is_null($account_category)) {
            $account_category = new AccountCategory();
        }

        $account_category->fill($request->all())->save();

    }

    //Update account category
    public function updateAccountCategory($request)
    {
        self::store($request, $this);
    }
}
