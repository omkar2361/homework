<?php

namespace App\Model;

use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class PersonAddress extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $fillable = [
        "type",
        "line_1",
        "line_2",
        "line_3",
        "line_4",
        "line_5",
        "state",
        "city",
        "country",
        "postal_code",
        "is_same_as_billing",
        "note",
    ];
    protected $table = 'person_addresses';
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        "line_1" => "string",
        "line_2" => "string",
        "line_3" => "string",
        "line_4" => "string",
        "line_5" => "string",
        "state" => "string",
        "city" => "string",
        "type" => "string",
        "country" => "string",
        "postal_code" => "string",
        "note" => "string",
        "is_same_as_billing" => "integer",
        "person_id" => "integer",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    protected $rules = [
        'id' => ['exists:person_addresses,id'],
        'type' => ['required', 'in:Primary,Billing,Shipping'],
    ];

    //Relationships
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    //CRUD
    public static function store($request, $person)
    {
        $records = [];

        foreach ($request as $_request) {
            $record = new PersonAddress();

            if (isset($_request["id"]) && $_request["id"] != null) {
                $record = $person->addresses()
                    ->whereId($_request["id"])
                    ->first();
            }

            if ($_request["is_same_as_billing"] === true && $_request["type"] === "Shipping") {
                $billing_address = $person->addresses()->whereType("Primary")->first();

                if (isset($_request["id"]) && $_request["id"] != null) {
                    $record = self::findOrFail($_request["id"]);
                    $record->id = $_request["id"];
                } else {
                    $record = $billing_address->replicate();
                    $record->id = null;
                    $record->is_same_as_billing = true;
                }
            }

            $record->fill($_request);
            $record->person()->associate($person);
            $record->save();

            $records[] = $record->id;
        }

        $person->addresses()->whereNotIn("id", $records)->delete();
    }
}
