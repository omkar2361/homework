<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmazonOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('amazon_order_items');
        Schema::create('amazon_order_items', function (Blueprint $table) {
            $table->string('OrderItemId')->primary();
            $table->unsignedBigInteger('amazon_store_id');
            $table->foreign('amazon_store_id')->references('id')->on('amazon_stores')->onDelete('cascade');
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->string('AmazonOrderId');
            $table->foreign('AmazonOrderId')->references('AmazonOrderId')->on('amazon_orders')->onDelete('cascade');
            $table->string('ASIN')->nullable();
            $table->string('SellerSKU')->nullable();
            $table->jsonb('BuyerCustomizedInfo')->nullable();
            $table->string('Title')->nullable();
            $table->integer('QuantityOrdered')->nullable();
            $table->integer('QuantityShipped')->nullable();
            $table->jsonb('ProductInfo')->nullable();
            $table->jsonb('PointsGranted')->nullable();
            $table->jsonb('ItemPrice')->nullable();
            $table->jsonb('ItemTax')->nullable();
            $table->jsonb('PromotionDiscount')->nullable();
            $table->jsonb('ShippingDiscount')->nullable();
            $table->jsonb('PromotionIds')->nullable();
            $table->jsonb('ShippingTax')->nullable();
            $table->jsonb('ShippingPrice')->nullable();
            $table->datetime('ScheduledDeliveryStartDate')->nullable();
            $table->datetime('ScheduledDeliveryEndDate')->nullable();
            $table->jsonb('CODFee')->nullable();
            $table->jsonb('CODFeeDiscount')->nullable();
            $table->boolean('IsGift')->nullable();
            $table->boolean('IsTransparency')->nullable();
            $table->string('GiftMessageText')->nullable();
            $table->jsonb('GiftWrapPrice')->nullable();
            $table->string('GiftWrapLevel')->nullable();
            $table->string('PriceDesignation')->nullable();
            $table->unique(['OrderItemId', 'amazon_store_id', 'tenant_id', 'AmazonOrderId', 'SellerSKU', 'ASIN'], 'amazon_order_items_unique_order_item_id');
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
        Schema::dropIfExists('amazon_order_items');
    }
}
