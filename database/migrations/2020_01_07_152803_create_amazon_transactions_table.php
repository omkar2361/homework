<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmazonTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('TransactionType', ['Refund', 'Shipment']);

            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');

            $table->unsignedBigInteger('amazon_store_id');
            $table->foreign('amazon_store_id')->references('id')->on('amazon_stores');

            $table->string('AmazonOrderId');
            $table->foreign('AmazonOrderId')->references('AmazonOrderId')->on('amazon_orders');

            $table->string('OrderItemId');
            $table->foreign('OrderItemId')->references('OrderItemId')->on('amazon_order_items');

            $table->string('PostedDate')->nullable();

            $table->unique(['tenant_id', 'amazon_store_id', 'AmazonOrderId', 'OrderItemId', 'PostedDate'], 'amazon_transactions_amazonorderid_orderitemid_posteddate_unique');

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
        Schema::dropIfExists('amazon_transactions');
    }
}
