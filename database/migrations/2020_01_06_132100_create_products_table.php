<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->string('name');
            $table->string('description');
            $table->enum('type', ['Sale', 'Purchase']);
            $table->unsignedBigInteger('sale_account_id');
            $table->foreign('sale_account_id')->references('id')->on('accounts');
            $table->unsignedBigInteger('purchase_account_id');
            $table->foreign('purchase_account_id')->references('id')->on('accounts');
            $table->unsignedBigInteger('sale_tax_id');
            $table->foreign('sale_tax_id')->references('id')->on('taxes');
            $table->unsignedBigInteger('purchase_tax_id');
            $table->foreign('purchase_tax_id')->references('id')->on('taxes');
            $table->double('sale_price');
            $table->double('purchase_price');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('products');
    }
}
