<?php

namespace App\Model;

use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class PersonPhoneNumber extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        "phone_number_type",
        "phone_number",
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        "phone_number_type" => "string",
        "phone_number" => "string",
        "person_id" => "integer",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    protected $rules = [
        'id' => ['exists:person_phone_numbers,id'],
        'phone_number_type' => ['in:PhoneNumber,MobileNumber,FaxNumber'],
        'phone_number' => ['numeric'],
    ];

    //Relationship
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    //CRUD
    public static function store($request, $person)
    {
        $phone_numbers = [];

        foreach ($request as $_request) {
            $phone_number = new PersonPhoneNumber();

            if (isset($_request["id"]) && $_request["id"] != null) {
                $phone_number = $person->phoneNumbers()->whereId($_request["id"])->first();
            }

            $phone_number->fill($_request);
            $phone_number->person()->associate($person);
            $phone_number->save();

            $phone_numbers[] = $phone_number->id;
        }

        $person->phoneNumbers()->whereNotIn("id", $phone_numbers)->delete();
    }
}
