<?php

namespace App\Model;

use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class Unit extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        "name",
    ];

    protected $casts = [
        "name" => "string",
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
        "name" => ["required", "unique:units,name"],
    ];

    public static function store($request, $unit = null)
    {
        if (is_null($unit)) {
            $unit = new Unit();
        }

        return $unit->fill($request->all())->save();
    }

    public function updateUnit($request)
    {
        self::store($request, $this);
    }
}
