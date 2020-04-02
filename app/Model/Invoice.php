<?php

namespace App\Model;


use Watson\Validating\ValidatingTrait;
use Illuminate\Database\Eloquent\Model;
use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelFillableRelations\Eloquent\Concerns\HasFillableRelations;

use App\Model\InvoiceLineItem;

class Invoice extends Model
{
    use SoftDeletes, HasFillableRelations, ValidatingTrait, BelongsToTenants;

    protected $throwValidationExceptions = true;
    protected $injectUniqueIdentifier = true;

    protected $fillable = [
        'id',
        'transaction_id',
        'type',
        'term_id',
        'doc_number',
        'invoice_date',
        'note',
        'customer_id',
        'customer_memo',
        'add_billing_address',
        'add_shipping_address',
        'due_date',
        'shipping_method',
        'shipping_date',
        'tracking_number',
        'total_amount',
        'print_status',
        'email_status',
        'amount_tax_type',
        'billing_email_address',
        'apply_tax_after_discount',
        'total_tax',
        'place_of_supply_id',
        'deposit',
        'discount',
        'discount_amount',
        'discount_type',
        'shipping_tax_rate_id',
        'shipping_amount',
        'net_total_amount',
        'due_amount',
        'round_off',
    ];

    protected $dates = [
        'invoice_date',
        'due_date',
        'shipping_date',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'doc_number'                => 'integer',
        'invoice_date'              => 'date',
        'note'                      => 'string',
        'customer_id'               => 'integer',
        'customer_memo'             => 'string',
        'add_billing_address'       => 'string',
        'add_shipping_address'      => 'string',
        'due_date'                  => 'date',
        'shipping_method'           => 'string',
        'shipping_date'             => 'date',
        'tracking_number'           => 'string',
        'total_amount'              => 'double',
        'print_status'              => 'string',
        'email_status'              => 'string',
        'amount_tax_type'           => 'string',
        'billing_email_address'     => 'string',
        'apply_tax_after_discount'  => 'string',
        'total_tax'                 => 'double',
        'place_of_supply_id'        => 'integer',
        'deposit'                   => 'double',
        'discount'                  => 'double',
        'discount_amount'           => 'double',
        'discount_type'             => 'string',
        'shipping_tax_rate_id'      => 'integer',
        'shipping_amount'           => 'double',
        'net_total_amount'          => 'double',
        'due_amount'                => 'double',
        'round_off'                 => 'double',
        'created_at'                => 'datetime',
        'updated_at'                => 'datetime',
        'deleted_at'                => 'datetime'
    ];

    protected $rules = [
        'customer_id' => ['integer', 'exists:customer,id']
    ];

    protected $fillable_relations = [
        'invoiceLineItems'
    ];

    /**
     * Get the InvoiceLineItems for the Invoice.
     */
    public function invoiceLineItems()
    {
        return $this->hasMany(InvoiceLineItem::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    //Store
    public static function store($request, $invoice = null)
    {
        if (is_null($invoice)) {
            $invoice = new Invoice();
        }

        $invoice->fill($request->all())->save();
    }
}
