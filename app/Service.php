<?php

namespace App;

use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class Service extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        "name",
        "sku",
        "sac_code",
        "unit_id",
        "display_value",
        "category_id",
        "sell_this_product",
        "sale_description",
        "sale_price",
        "income_account_id",
        "is_inclusive_tax",
        "tax_id",
        "abatement",
        "service_id",
        "purchase_this_product",
        "purchase_description",
        "cost",
        "expense_account_id",
        "is_inclusive_purchase_tax",
        "purchase_tax_id",
        "reverse_charge",
        "preferred_supplier",
    ];

    protected $casts = [
        "name" => "string",
        "sku" => "string",
        "sac_code" => "string",
        "unit_id" => "integer",
        "display_value" => "string",
        "category_id" => "integer",
        "sell_this_product" => "boolean",
        "sale_description" => "text",
        "sale_price" => "float",
        "income_account_id" => "integer",
        "is_inclusive_tax" => "boolean",
        "tax_id" => "integer",
        "abatement" => "float",
        "service_id" => "integer",
        "purchase_this_product" => "boolean",
        "purchase_description" => "text",
        "cost" => "double",
        "expense_account_id" => "integer",
        "is_inclusive_purchase_tax" => "boolean",
        "purchase_tax_id" => "integer",
        "reverse_charge" => "float",
        "preferred_supplier" => "integer",
    ];

    protected $rules = [
        "name" => ["required"],
        "unit_id" => ["exists:units,id"],
        "category_id" => ["exists:categories,id"],
        "tax_id" => ["exists:taxes,id"],
        "purchase_tax_id" => ["exists:taxes,id"],
        "preferred_supplier" => ["exists:people,id"],
        "is_inclusive_tax" => ["boolean"],
        "is_inclusive_purchase_tax" => ["boolean"],
        "income_account_id" => ["exists:accounts,id"],
        "expense_account_id" => ["exists:accounts,id"],
        "sale_price" => ["numeric"],
        "cost" => ["numeric"],
        "reverse_charge" => ["numeric"],
    ];

    //Relationships

    //Store
    public static function store($request, $service = null)
    {
        if (is_null($service)) {
            $service = new Service();
        }

        return $service->fill($request->all())->save();
    }

    //Update
    public function updateService($request)
    {
        self::store($request, $this);
    }
}
