<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmazonReportProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('amazon_report_products', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('tenant_id');
        //     $table->foreign('tenant_id')->references('id')->on('tenants');
        //     $table->dateTime('ReportDate')->nullable();
        //     $table->integer('ShippedOrders')->nullable();
        //     $table->integer('PendingOrders')->nullable();
        //     $table->integer('CanceledOrders')->nullable();
        //     $table->integer('AllOrders')->nullable();
        //     $table->integer('ShippedUnits')->nullable();
        //     $table->integer('PendingUnits')->nullable();
        //     $table->integer('AllUnits')->nullable();
        //     $table->integer('CanceledUnits')->nullable();
        //     $table->double('AmazonFees')->nullable();
        //     $table->double('Tax')->nullable();
        //     $table->double('ReturnTax')->nullable();
        //     $table->double('PromotionDiscount')->nullable();
        //     $table->double('AdditionalCost')->nullable();
        //     $table->double('AdsCost')->nullable();
        //     $table->double('AveragePrice')->nullable();
        //     $table->integer('Clicks')->nullable();
        //     $table->double('Profit')->nullable();
        //     $table->double('EstimateProfit')->nullable();
        //     $table->integer('Returns')->nullable();
        //     $table->double('ReturnsPercentage')->nullable();
        //     $table->double('ReturnsAmount')->nullable();
        //     $table->double('ConversionRate')->nullable();
        //     $table->double('Sales')->nullable();
        //     $table->double('Rank')->nullable();
        //     $table->double('Stock')->nullable();
        //     $table->integer('Reviews')->nullable();
        //     $table->double('ReturnUnits')->nullable();
        //     $table->double('Coupons')->nullable();
        //     $table->double('CouponsAmount')->nullable();
        //     $table->double('StorageFee')->nullable();
        //     $table->double('CostPrice')->nullable();
        //     $table->double('InboundStock')->nullable();
        //     $table->double('ReservedStock')->nullable();
        //     $table->double('AvailableStock')->nullable();
        //     $table->double('SbCost')->nullable();
        //     $table->double('AdsUnitsOtherSku')->nullable();
        //     $table->double('Session')->nullable();
        //     $table->double('BuyBoxPercentage')->nullable();
        //     $table->double('UnitSessionPercentage')->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('amazon_report_products');
    }
}
