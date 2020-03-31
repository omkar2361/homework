<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->string('name');
            $table->string('sku')->nullable();
            $table->string('hsn_code')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units');
            $table->string('display_value')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->bigInteger('quantity_on_hand')->nullable();
            $table->date('as_of_date')->nullable();
            $table->bigInteger('low_stock_alert')->nullable();
            $table->string('inventory_asset_account')->nullable();
            $table->text('sale_description')->nullable();
            $table->string('sale_price')->nullable();
            $table->unsignedBigInteger('income_account_id')->nullable();
            $table->foreign('income_account_id')->references('id')->on('accounts');
            $table->boolean('is_inclusive_tax')->nullable();
            $table->unsignedBigInteger('tax_id')->nullable();
            $table->foreign('tax_id')->references('id')->on('taxes');
            $table->text('purchase_description')->nullable();
            $table->double('cost')->nullable();
            $table->unsignedBigInteger('expense_account_id')->nullable();
            $table->foreign('expense_account_id')->references('id')->on('accounts');
            $table->boolean('is_inclusive_purchase_tax')->nullable();
            $table->unsignedBigInteger('purchase_tax_id')->nullable();
            $table->foreign('purchase_tax_id')->references('id')->on('taxes');
            $table->float('reverse_charge')->nullable();
            $table->unsignedBigInteger('preferred_supplier')->nullable();
            $table->foreign('preferred_supplier')->references('id')->on('people');
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
        Schema::dropIfExists('inventories');
    }
}
