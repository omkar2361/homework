<?php

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class TimeCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        $value = Carbon::parse($value);

        return [
            "hour" => $value->hour,
            "minute" => $value->minute,
            "second" => $value->second,
        ];
    }

    public function set($model, $key, $value, $attributes)
    {
        $value = Carbon::createFromTime($value["hour"], $value["minute"], $value["second"]);
        return $value;
    }
}
