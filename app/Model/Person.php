<?php

namespace App\Model;

use App\Model\PersonEmail;
use App\Model\PersonNote;
use App\Model\PersonPhoneNumber;
use App\Model\PersonTaxNumber;
use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class Person extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        "title",
        "first_name",
        "middle_name",
        "last_name",
        "type",
        "suffix",
        "website_uri",
        "company",

    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        "title" => "string",
        "first_name" => "string",
        "middle_name" => "string",
        "last_name" => "string",
        "type" => "string",
        "suffix" => "string",
        "website_uri" => "string",
        "company" => "string",
        "term_id" => "integer",
        "created_at" => "datetime",
        "updated_at" => "datetime",

    ];

    protected $rules = [
        "first_name" => ["required"],
    ];

    //Relationship
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function phoneNumbers()
    {
        return $this->hasMany(PersonPhoneNumber::class);
    }

    public function addresses()
    {
        return $this->hasMany(PersonAddress::class);
    }

    public function emails()
    {
        return $this->hasMany(PersonEmail::class);
    }

    public function notes()
    {
        return $this->hasMany(PersonNote::class);
    }

    public function taxNumbers()
    {
        return $this->hasMany(PersonTaxNumber::class);
    }

    //Store
    public static function store($request, $person = null)
    {
        if (is_null($person)) {
            $person = new Person();
        }

        $person->fill($request->all())->save();

        //Associate relationships
        $person->associateRelationships($request);
    }

    public function associateRelationships($request)
    {
        if ($request->filled('emails')) {
            PersonEmail::store($request->emails, $this);
        }

        if ($request->filled('phone_numbers')) {
            PersonPhoneNumber::store($request->phone_numbers, $this);
        }

        if ($request->filled('notes')) {
            PersonNote::store($request->notes, $this);
        }

        if ($request->filled('tax_numbers')) {
            PersonTaxNumber::store($request->tax_numbers, $this);
        }

        if ($request->filled('addresses')) {
            PersonAddress::store($request->addresses, $this);
        }
    }

    //Update
    public function updatePerson($request)
    {
        self::store($request, $this);
    }
}
