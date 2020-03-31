<?php

namespace App;

use App\Casts\DateCast;
use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class Inventory extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        "name",
        "sku",
        "hsn_code",
        "unit_id",
        "display_value",
        "category_id",
        "quantity_on_hand",
        "as_of_date",
        "low_stock_alert",
        "inventory_asset_account",
        "sale_description",
        "sale_price",
        "income_account_id",
        "is_inclusive_tax",
        "tax_id",
        "purchase_description",
        "cost",
        "expense_account_id",
        "is_inclusive_purchase_tax",
        "purchase_tax_id",
        "reverse_charge",
        "preferred_supplier",
    ];

    protected $casts = [
        "id" => "integer",
        "name" => "string",
        "sku" => "string",
        "hsn_code" => "string",
        "unit_id" => "integer",
        "display_value" => "string",
        "category_id" => "integer",
        "quantity_on_hand" => "integer",
        "as_of_date" => DateCast::class,
        "low_stock_alert" => "integer",
        "inventory_asset_account" => "string",
        "sale_description" => "text",
        "sale_price" => "double",
        "income_account_id" => "integer",
        "is_inclusive_tax" => "boolean",
        "tax_id" => "integer",
        "purchase_description" => "text",
        "cost" => "double",
        "expense_account_id" => "integer",
        "is_inclusive_purchase_tax" => "boolean",
        "purchase_tax_id" => "integer",
        "reverse_charge" => "float",
        "preferred_supplier" => "integer",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "deleted_at" => "datetime",
    ];

    protected $rules = [
        "name" => ["required"],
        "unit_id" => ["exists:units,id"],
        "category_id" => ["exists:categories,id"],
        "tax_id" => ["exists:taxes,id"],
        "purchase_tax_id" => ["exists:taxes,id"],
        "low_stock_alert" => ["integer"],
        "preferred_supplier" => ["exists:people,id"],
        "is_inclusive_tax" => ["boolean"],
        "is_inclusive_purchase_tax" => ["boolean"],
        "quantity_on_hand" => ["required"],
        "income_account_id" => ["exists:accounts,id"],
        "expense_account_id" => ["exists:accounts,id"],
        "sale_price" => ["numeric"],
        "cost" => ["numeric"],
        "reverse_charge" => ["numeric"],
    ];

    //Relationships
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Store
    public static function store($request, $inventory = null)
    {
        if (is_null($inventory)) {
            $inventory = new Inventory();
        }

        $inventory->fill($request->all())->save();
    }

    //update
    public function updateInventory($request)
    {
        self::store($request, $this);
    }
}
