<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "customer_id",
        "email",
        "cc",
        "bcc",
        "send_later",
        "payment_date",
        "payment_method",
        "reference_number",
        "deposite_to",
        "amount_recieved",
        "memo",
    ];

    protected $casts = [
        "id" => "integer",
        "customer_id" => "integer",
        "email" => "string",
        "cc" => "string",
        "bcc" => "string",
        "send_later" => "boolean",
        "payment_date" => "date",
        "payment_method" => "string",
        "reference_number" => "string",
        "deposite_to" => "integer",
        "amount_recieved" => "double",
        "memo" => "text",
    ];
    //Relationship
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    //Validation rule
    public static function validationRules()
    {
        return [
            "customer_id" => ["required", "integer", "exists:customers,id"],
            "email" => ["required"],
            "send_later" => ["boolean"],
            "deposite_to" => ["required", "integer", "exists:accounts,id"],
        ];
    }

    //Store
    public static function store($request, $payment = null)
    {
        if (is_null($payment)) {
            $payment = new Payment();
        }

        $payment->fill($request->all())->save();
    }

    public function updatePayment($request)
    {
        self::store($request, $this);
    }
}
