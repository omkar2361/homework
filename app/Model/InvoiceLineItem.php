<?php

namespace App\Model;


use App\Model\Invoice;
use Watson\Validating\ValidatingTrait;
use Illuminate\Database\Eloquent\Model;
use HipsterJazzbo\Landlord\BelongsToTenants;

use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelFillableRelations\Eloquent\Concerns\HasFillableRelations;

class InvoiceLineItem extends Model
{
    use SoftDeletes, HasFillableRelations, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        'id',
        'item_id',
        'invoice_id',
        'line_number',
        'description',
        'quantity',
        'unit_price',
        'amount',
        'service_date',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'item_id'       => 'integer',
        'invoice_id'    => 'integer',
        'line_number'   => 'string',
        'description'   => 'string',
        'quantity'      => 'double',
        'unit_price'    => 'double',
        'amount'        => 'double',
        'service_date'  => 'date',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime'
    ];

    protected $rules = [];

    protected $fillable_relations = [
        'invoice'
    ];

    //Relationships
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
