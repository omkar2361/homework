<?php

namespace App\Model;

use App\Casts\DateCast;
use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class Account extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        "name",
        "description",
        "unpaid_balance",
        "unpaid_balance_date",
        "account_type",
        "account_sub_type",
        "account_number",
        "is_sub_account",
        "current_balance",
        "current_balance_date",
        "type",
        "can_delete",
        "account_category_id",
        "tax_id",
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        "name" => 'string',
        "description" => 'string',
        "parent_id" => 'integer',
        "unpaid_balance" => 'double',
        "unpaid_balance_date" => DateCast::class,
        "account_type" => 'string',
        "account_sub_type" => 'string',
        "type" => 'string',
        "account_number" => 'string',
        "is_sub_account" => 'boolean',
        "can_delete" => 'boolean',
        "current_balance" => 'double',
        "current_balance_date" => DateCast::class,
        "account_category_id" => 'integer',
        "tax_id" => 'integer',
        "created_at" => 'datetime',
        "updated_at" => 'datetime',
        "deleted_at" => 'datetime',
    ];

    //Validation rules
    protected $rules = [
        'name' => ['required', 'unique:accounts,name,NULL,id,tenant_id,2'],
        // 'tenant_id' => ['exists:tenants,id', 'unique:accounts,tenant_id'],
        'is_sub_account' => ['boolean'],
        'description' => ['max:255'],
        'account_number' => ['required', 'integer', 'unique:accounts,account_number'],
        // 'account_category_id' => ['required', 'exists:account_categories,id'],
        "tax_id" => ["integer", "exists:taxes,id"],

    ];

    //Relationships
    public function accountCategory()
    {
        return $this->belongsTo(AccountCategory::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function account()
    {
        return $this->hasOne(Account::class, 'parent_id');
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
