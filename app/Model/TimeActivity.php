<?php

namespace App\Model;

use App\Casts\DateCast;
use App\Casts\TimeCast;
use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class TimeActivity extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $fillable = [
        "activity_date",
        "name",
        "customer_id",
        "hourly_rate",
        "use_start_end_time",
        "start_time",
        "end_time",
        "break_duration",
        "description",
    ];

    protected $casts = [
        "id" => "integer",
        "activity_date" => DateCast::class,
        "name" => "integer",
        "customer_id" => "integer",
        "hourly_rate" => "float",
        "use_start_end_time" => "boolean",
        "start_time" => TimeCast::class,
        "end_time" => TimeCast::class,
        "break_duration" => TimeCast::class,
        "description" => "text",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "deleted_at" => "datetime",
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $rules = [
        "customer_id" => ["exists:people,id"],
        "name" => ["exists:people,id"],
        "use_start_end_time" => ["boolean"],
    ];

    //Realtionship

    //Store
    public static function store($request, $activity = null)
    {

        if (is_null($activity)) {
            $activity = new TimeActivity();
        }

        $activity->fill($request->all())->save();
    }

    //Update
    public function updateActivity($request)
    {
        self::store($request, $this);
    }
}
