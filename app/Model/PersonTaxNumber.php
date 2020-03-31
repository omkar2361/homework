<?php

namespace App\Model;

use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class PersonTaxNumber extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        "type",
        "tax_number",
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        "type" => "string",
        "tax_number" => "string",
        "person_id" => "integer",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    protected $rules = [
        'id' => ['exists:person_tax_numbers,id'],
        'type' => ['in:GST,VAT,CST,PAN'],
        'tax_number' => ['numeric', 'digits_between:1,16'],
    ];

    //Relationship
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    //CRUD
    public static function store($request, $person)
    {
        $person_tax_numbers = [];

        foreach ($request as $_request) {
            $person_tax_number = new PersonTaxNumber();

            if (isset($_request["type"]) && $_request["type"] != null && isset($_request["id"]) && $_request["id"] != null) {
                $person_tax_number = $person->taxNumbers()->whereType($_request["type"])->get();

                if (sizeof($person_tax_number) === 1) {
                    $person_tax_number = $person_tax_number->first();
                }
            }

            $person_tax_number->fill($_request);
            $person_tax_number->person()->associate($person);
            $person_tax_number->save();

            $person_tax_numbers[] = $person_tax_number->id;
        }

        $person->taxNumbers()->whereNotIn("id", $person_tax_numbers)->delete();
    }
}
