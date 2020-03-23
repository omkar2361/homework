<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmazonTransactionFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_transaction_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('TransactionType', ['Refund', 'Shipment']);

            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');

            $table->unsignedBigInteger('amazon_store_id');
            $table->foreign('amazon_store_id')->references('id')->on('amazon_stores');

            $table->string('AmazonOrderId');
            $table->foreign('AmazonOrderId')->references('AmazonOrderId')->on('amazon_orders')->onDelete('cascade');

            $table->string('OrderItemId');
            $table->foreign('OrderItemId')->references('OrderItemId')->on('amazon_order_items')->onDelete('cascade');

            $table->string('ASIN')->nullable();
            $table->string('SellerSKU')->nullable();
            $table->string('PostedDate');
            $table->string('sub_type')->nullable();
            $table->string('CurrencyCode')->nullable();
            $table->double('Amount')->nullable();
            $table->string('type')->nullable();
            // $table->unique(['tenant_id', 'amazon_store_id', 'AmazonOrderId', 'OrderItemId', 'PostedDate']);

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
        Schema::dropIfExists('amazon_transaction_fees');
    }
}
