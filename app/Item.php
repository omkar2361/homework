<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "sale_transaction_id",
        "description",
        "quantity",
        "rate",
        "amount",
        "tax_id",
        "tax_amount",
        "net_amount",
        "tax_inclusive_amount",
        "item_type",
    ];

    protected $casts = [
        "id" => "integer",
        "sale_transaction_id" => "integer",
        "description" => "text",
        "quantity" => "integer",
        "rate" => "float",
        "amount" => "integer",
        "tax_id" => "integer",
        "tax_amount" => "float",
        "net_amount" => "double",
        "tax_inclusive_amount" => "double",
        "item_type" => "string",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "deleted_at" => "datetime",
    ];

    public function saleTransaction()
    {
        return $this->belongsTo(SaleTransaction::class);
    }

    public static function validationRules($prefix)
    {

        $rules = [
            $prefix . "description" => ["required"],
            $prefix . "quantity" => ["required", "numeric"],
            $prefix . "rate" => ["required"],
            $prefix . "amount" => ["required", "numeric"],
            $prefix . "net_amount" => ["required", "numeric"],
            $prefix . "item_type" => ["required"],
        ];

        return $rules;
    }

    public static function store($request, $record = null)
    {
        $record_ids = [];
        foreach ($request as $_request) {
            if (isset($_request->id) && !is_null($_request->id)) {
                $item = Item::findOrFail($_request->id);
            } else {
                $item = new Item();
            }

            $item->fill($_request);
            $item->sale_transaction_id = @$record->id;
            $item->save();

            $record_ids[] = $item->id;
        }

        if ($record) {
            $record->items()->whereNotIn('id', $record_ids)->delete();
        }

    }
}
