<?php

namespace App\Model;

use App\Account;
use App\Casts\DateCast;
use App\Model\Person;
use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class Transaction extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        "customer_id",
        "vendor_id",
        "person_id",
        "account_id",
        "transaction_date",
        "doc_number",
        "type",
        "module",
        "due_date",
        "balance",
        "total_before_tax",
        "tax",
        "total",
        "status",
    ];

    protected $casts = [
        "tenant_id" => "integer",
        "customer_id" => "integer",
        "vendor_id" => "integer",
        "person_id" => "integer",
        "account_id" => "integer",
        "transaction_date" => DateCast::class,
        "doc_number" => "string",
        "type" => "string",
        "module" => "string",
        "due_date" => DateCast::class,
        "balance" => "numeric",
        "total_before_tax" => "numeric",
        "tax" => "numeric",
        "total" => "numeric",
        "status" => "string",
        "created_at" => 'datetime',
        "updated_at" => 'datetime',
        "deleted_at" => 'datetime',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $rules = [
        "customer_id" => ["integer"],
        "vendor_id" => ["integer"],
        "person_id" => ["integer", "exists:people,id"],
        "account_id" => ["integer", "exists:accounts,id"],
    ];

    //Relationship
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
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
