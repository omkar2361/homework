<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "customer_id",
        "email",
        "billing_address",
        "terms",
        "date",
        "due_date",
        "number",
        "location_id",
        "type",
    ];

    protected $casts = [
        "id" => "integer",
        "customer_id" => "integer",
        "email" => "string",
        "billing_address" => "array",
        "terms" => "string",
        "date" => "date",
        "due_date" => "date",
        "number" => "integer",
        "location_id" => "integer",
        "type" => "string",
    ];

    public static function validationRules($request)
    {
        $rules = collect([
            "customer_id" => ["required", "exists:customers,id"],
            "email" => ["required"],
            "terms" => ["required"],
            "date" => ["required"],
            "due_date" => ["required"],
            "number" => ["required"],
            "location_id" => ["required"],
        ]);

        if (isset($request->billing_address)) {
            $rules = $rules->merge([
                "billing_address.street" => ["required"],
                "billing_address.city" => ["required"],
                "billing_address.state" => ["required"],
                "billing_address.country" => ["required"],
                "billing_address.pin_code" => ["required"],
            ]);
        }

        if (isset($request->items)) {
            $rules = $rules->merge(Item::validationRules("items.*."));
        }

        return $rules->all();
    }
    //Relationship
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    //Store
    public static function store($request, $sale_transaction = null)
    {

        if (is_null($sale_transaction)) {
            $sale_transaction = new SaleTransaction();
        }

        $sale_transaction->fill($request->all())->save();

        //save associated relationship data
        $sale_transaction->associateRelationship($request);
    }

    public function associateRelationship($request)
    {
        //Save Items
        if (request()->filled('items')) {
            Item::store($request->items, $this);
        }
    }

    //Update
    public function updateSaleTransaction($request)
    {
        self::store($request, $this);
    }
}
