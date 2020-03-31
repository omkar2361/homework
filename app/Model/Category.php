<?php

namespace App\Model;

use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class Category extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        "name",
        "is_sub_category",
        "parent_id",
    ];

    protected $casts = [
        "name" => "string",
        "is_sub_category" => "boolean",
        "parent_id" => "integer",
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
        "name" => ["required", "unique:categories,name"],
        "is_sub_category" => ["boolean"],
        "parent_id" => ["required_if:is_sub_category,true"],
    ];

    //Store
    public static function store($request, $category = null)
    {
        if (is_null($category)) {
            $category = new Category();
        }

        return $category->fill($request->all())->save();
    }

    //Update
    public function updateCategory($request)
    {
        self::store($request, $this);
    }
}
