<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmazonInventoryReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('amazon_inventory_reports');
        Schema::create('amazon_inventory_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('amazon_store_id');
            $table->foreign('amazon_store_id')->references('id')->on('amazon_stores')->onDelete('cascade');
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->date('report_date');
            $table->string('country')->nullable();
            $table->text('product_description')->nullable();
            $table->string('fnsku')->nullable();
            $table->string('SellerSKU');
            $table->string('ASIN')->nullable();
            $table->string('condition')->nullable();
            $table->string('supplier')->nullable();
            $table->string('supplier_part_no')->nullable();
            $table->string('currency_code')->nullable();
            $table->float('price')->nullable();
            $table->float('sales_last_30_days_sales')->nullable();
            $table->string('sales_last_30_days_units')->nullable();
            $table->string('total_inventory')->nullable();
            $table->string('inbound_inventory')->nullable();
            $table->string('available_inventory')->nullable();
            $table->string('reserved_fc_transfer')->nullable();
            $table->string('reserved_fc_processing')->nullable();
            $table->string('reserved_customer_order')->nullable();
            $table->string('unfulfillable')->nullable();
            $table->string('fulfilled_by')->nullable();
            $table->string('days_of_supply')->nullable();
            $table->string('instock_alert')->nullable();
            $table->string('recommended_order_quantity')->nullable();
            $table->string('recommended_order_date')->nullable();
            $table->string('eligible_for_storage_fee_discount_current_month')->nullable();
            $table->string('eligible_for_storage_fee_discount_next_month')->nullable();
            $table->string('current_month_very_low_inventory_threshold')->nullable();
            $table->string('current_month_storage_discount_minimum_inventory_threshold')->nullable();
            $table->string('current_month_storage_discount_maximum_inventory_threshold')->nullable();
            $table->string('current_month_very_high_inventory_threshold')->nullable();
            $table->string('next_month_very_low_inventory_threshold')->nullable();
            $table->string('next_month_storage_discount_minimum_inventory_threshold')->nullable();
            $table->string('next_month_storage_discount_maximum_inventory_threshold')->nullable();
            $table->string('next_month_very_high_inventory_threshold')->nullable();
            $table->unique(['tenant_id', 'amazon_store_id', 'ASIN', 'SellerSKU', 'report_date'], 'amazon_inventory_reports_unique_seller_sku_report_date');
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
        Schema::dropIfExists('amazon_inventory_reports');
    }
}
