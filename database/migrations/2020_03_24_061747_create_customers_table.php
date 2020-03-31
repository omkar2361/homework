<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->string('title');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('display_name')->nullable();
            $table->jsonb('contact_info')->nullable();
            $table->jsonb('billing_address')->nullable();
            $table->jsonb('shipping_address')->nullable();
            $table->jsonb('tax_info')->nullable();
            $table->text('notes')->nullable();
            $table->jsonb('attachments')->nullable();
            $table->string('gst_registration_type')->nullable();
            $table->string('gstin')->nullable();
            $table->boolean('is_sub_customer')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->enum('bill_with', ['Customer', 'Parent'])->nullable();
            $table->string('payment_method')->nullable();
            $table->string('term')->nullable();
            $table->string('delivery_method')->nullable();
            $table->double('opening_balance')->nullable();
            $table->date('opening_balance_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
