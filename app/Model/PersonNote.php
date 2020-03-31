<?php

namespace App\Model;

use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class PersonNote extends Model
{
    use SoftDeletes, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        "note",
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        "note" => "text",
        "person_id" => "integer",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    protected $rules = [
        'id' => ['exists:person_notes,id'],
        'note' => ['required', 'max:255'],
    ];

    //Relationship
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    //CRUD
    public static function store($request, $person)
    {
        $person_notes = [];

        foreach ($request as $_request) {
            $person_note = new PersonNote();

            if (isset($_request["id"]) && $_request["id"] != null) {
                $person_note = $person->notes()->whereId($_request["id"])->first();
            }

            $person_note->fill($_request);
            $person_note->person()->associate($person);
            $person_note->save();

            $person_notes[] = $person_note->id;
        }

        $person->notes()->whereNotIn("id", $person_notes)->delete();
    }
}
