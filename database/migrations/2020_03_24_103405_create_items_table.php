<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->unsignedBigInteger('sale_transaction_id');
            $table->foreign('sale_transaction_id')->references('id')->on('sale_transactions');
            $table->text('description');
            $table->bigInteger('quantity');
            $table->float('rate');
            $table->double('amount');
            $table->unsignedBigInteger('tax_id');
            $table->float('tax_amount');
            $table->double('net_amount');
            $table->double('tax_inclusive_amount');
            $table->string('item_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
