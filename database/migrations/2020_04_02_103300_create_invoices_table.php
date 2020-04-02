<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->unsignedBigInteger('transaction_id');
            $table->enum('type', ['Invoice', 'Estimate', 'SaleReceipt', 'CreditNote', 'DelayedCharge']);
            $table->unsignedBigInteger('term_id')->nullable();
            $table->string('doc_number')->unique();
            $table->date('invoice_date');
            $table->string('note')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->string('customer_memo')->nullable();
            $table->string('add_billing_address')->nullable();
            $table->string('add_shipping_address')->nullable();
            $table->date('due_date')->nullable();
            $table->string('shipping_method')->nullable();
            $table->date('shipping_date')->nullable();
            $table->string('tracking_number')->nullable();
            $table->double('total_amount');
            $table->enum('print_status', ['Custom', 'Automatic'])->nullable();
            $table->string('email_status')->nullable();
            $table->enum('amount_tax_type', ['ExcludingTax', 'IncludingTax', 'OutOfScopeTax']);
            $table->string('billing_email_address')->nullable();
            $table->string('apply_tax_after_discount')->nullable();
            $table->double('total_tax')->nullable();
            $table->unsignedBigInteger('place_of_supply_id')->nullable();
            $table->double('deposit')->nullable();
            $table->double('discount')->nullable();
            $table->double('discount_amount')->nullable();
            $table->enum('discount_type', ['Value', 'Percent'])->nullable();
            $table->unsignedBigInteger('shipping_tax_rate_id')->nullable();
            $table->double('shipping_amount')->nullable();
            $table->double('net_total_amount')->nullable();
            $table->double('due_amount')->nullable();
            $table->double('round_off')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
