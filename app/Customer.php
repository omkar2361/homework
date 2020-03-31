<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class Customer extends Model
{
    use SoftDeletes, ValidatingTrait;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        "title",
        "first_name",
        "middle_name",
        "last_name",
        "suffix",
        "display_name",
        "contact_info",
        "billing_address",
        "shipping_address",
        "tax_info",
        "notes",
        "attachments",
        "gst_registration_type",
        "gstin",
        "is_sub_customer",
        "parent_id",
        "bill_with",
        "payment_method",
        "term",
        "delivery_method",
        "opening_balance",
        "opening_balance_date",

    ];

    protected $casts = [
        "id" => "integer",
        "title" => "string",
        "first_name" => "string",
        "middle_name" => "string",
        "last_name" => "string",
        "suffix" => "string",
        "display_name" => "string",
        "contact_info" => "array",
        "billing_address" => "array",
        "shipping_address" => "array",
        "tax_info" => "array",
        "notes" => "text",
        "attachments" => "array",
        "gst_registration_type" => "string",
        "gstin" => "string",
        "is_sub_customer" => "boolean",
        "parent_id" => "integer",
        "bill_with" => "string",
        "payment_method" => "string",
        "term" => "string",
        "delivery_method" => "string",
        "opening_balance" => "numeric",
        "opening_balance_date" => "date",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "deleted_at" => "datetime",
    ];

    protected $rules = [

    ];

    //Validation
    public static function validationRules($request, $id = null)
    {
        $rules = collect([
            "first_name" => ["required"],

        ]);

        if (isset($request->contact_info)) {
            $rules = $rules->merge([
                "contact_info.email" => ["required"],
                "contact_info.mobile" => ["required"],
            ]);
        }

        if (isset($request->billing_address)) {
            $rules = $rules->merge([
                "billing_address.street" => ["required"],
                "billing_address.city" => ["required"],
                "billing_address.state" => ["required"],
                "billing_address.pin_code" => ["required"],
                "billing_address.country" => ["required"],
            ]);
        }

        return $rules->all();
    }

    //Store
    public static function store($request, $customer = null)
    {
        if (is_null($customer)) {
            $customer = new Customer();
        }

        $customer->fill($request->all())->save();

        //Associate relation
        $customer->associateRelationship();
    }

    public function associateRelationship()
    {
        # code...
    }

    //Update
    public function updateCustomer($request)
    {
        self::store($request, $this);
    }
}
