<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmazonOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('amazon_store_id');
            $table->foreign('amazon_store_id')->references('id')->on('amazon_stores')->onDelete('cascade');
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->string('AmazonOrderId')->primary();
            $table->string('SellerOrderId')->nullable();
            $table->dateTime('PurchaseDate')->nullable();
            $table->dateTime('LastUpdateDate')->nullable();
            $table->string('OrderStatus')->nullable();
            $table->string('FulfillmentChannel')->nullable();
            $table->string('SalesChannel')->nullable();
            $table->string('ShipServiceLevel')->nullable();
            $table->jsonb('OrderTotal')->nullable();
            $table->string('NumberOfItemsShipped')->nullable();
            $table->string('NumberOfItemsUnshipped')->nullable();
            $table->jsonb('PaymentMethodDetails')->nullable();
            $table->string('BuyerEmail')->nullable();
            $table->dateTime('EarliestShipDate')->nullable();
            $table->dateTime('LatestShipDate')->nullable();
            $table->string('OrderType')->nullable();
            $table->jsonb('ShippingAddress')->nullable();
            $table->boolean('IsReplacementOrder')->nullable();
            $table->boolean('IsBusinessOrder')->nullable();
            $table->boolean('IsPremiumOrder')->nullable();
            $table->boolean('IsPrime')->nullable();
            $table->string('MarketplaceId')->nullable();
            $table->string('PaymentMethod')->nullable();
            $table->string('ShipmentServiceLevelCategory')->nullable();
            $table->boolean('is_item_fetched')->default(false);
            $table->unique(['amazon_store_id', 'tenant_id', 'AmazonOrderId']);
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
        Schema::dropIfExists('amazon_orders');
    }
}
