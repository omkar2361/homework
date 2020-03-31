<?php

namespace App\Model;

use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class AccountCategory extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        "parent_id",
        "display_name",
        "is_sub_category",
        "description",
        "is_unpaid_balance_required",
        "is_unpaid_balance_date_required",
        "is_current_balance_required",
        "is_current_balance_date_required",
    ];

    protected $casts = [
        "tenant_id" => "integer",
        "parent_id" => "integer",
        "display_name" => "string",
        "is_sub_category" => "boolean",
        "description" => "text",
        "is_unpaid_balance_required" => "boolean",
        "is_unpaid_balance_date_required" => "boolean",
        "is_current_balance_required" => "boolean",
        "is_current_balance_date_required" => "boolean",
        "created_at" => 'datetime',
        "updated_at" => 'datetime',
        "deleted_at" => 'datetime',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //Validation rules
    protected $rules = [
        "parent_id" => ["required_if:is_sub_category,true", "sometimes", "nullable", "exists:account_categories,id"],
        "display_name" => ["required", "unique:account_categories,display_name"],
        "is_sub_category" => ["boolean"],
        "is_unpaid_balance_required" => ["boolean"],
        "is_unpaid_balance_date_required" => ["boolean"],
        "is_current_balance_required" => ["boolean"],
        "is_current_balance_date_required" => ["boolean"],
    ];

    //Relationships
    public function accountSubCategories()
    {
        return $this->hasMany(AccountCategory::class, 'parent_id');
    }

    public function parentAccountCategory()
    {
        return $this->belongsTo(AccountCategory::class, 'parent_id');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
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
