<?php

namespace App\Model;

use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class PersonEmail extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        "email_type",
        "email",
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        "email_type" => "string",
        "email" => "string",
        "person_id" => "integer",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    protected $rules = [
        'id' => ['exists:person_emails,id'],
        'email' => ['nullable', 'email'],
        'email_type' => ['in:PrimaryEmail,AlternateEmail'],
    ];

    //Relationship
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    //CRUD
    public static function store($request, $person)
    {

        $emails = [];

        foreach ($request as $_request) {
            $email = new PersonEmail();

            if (isset($_request["id"]) && $_request["id"] != null) {
                $email = $person->emails()->whereId($_request["id"])->first();
            }

            $email->fill($_request);
            $email->person()->associate($person);
            $email->save();

            $emails[] = $email->id;
        }

        $person->emails()->whereNotIn("id", $emails)->delete();
    }
}
