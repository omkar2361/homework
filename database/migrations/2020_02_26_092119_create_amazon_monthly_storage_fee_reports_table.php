<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmazonMonthlyStorageFeeReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('amazon_monthly_storage_fee_reports');
        Schema::create('amazon_monthly_storage_fee_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('amazon_store_id');
            $table->foreign('amazon_store_id')->references('id')->on('amazon_stores')->onDelete('cascade');
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->date('report_date');
            $table->string('ASIN')->nullable();
            $table->string('fnsku')->nullable();
            $table->string('product_name')->nullable();
            $table->string('fulfillment_center')->nullable();
            $table->string('country_code')->nullable();
            $table->double('longest_side')->nullable();
            $table->double('median_side')->nullable();
            $table->double('shortest_side')->nullable();
            $table->string('measurement_units')->nullable();
            $table->double('weight')->nullable();
            $table->string('weight_units')->nullable();
            $table->double('item_volume')->nullable();
            $table->string('volume_units')->nullable();
            $table->string('product_size_tier')->nullable();
            $table->double('average_quantity_on_hand')->nullable();
            $table->double('average_quantity_pending_removal')->nullable();
            $table->double('estimated_total_item_volume')->nullable();
            $table->date('month_of_charge')->nullable();
            $table->double('storage_rate')->nullable();
            $table->string('currency')->nullable();
            $table->double('estimated_monthly_storage_fee')->nullable();
            $table->string('dangerous_goods_storage_type')->nullable();
            $table->boolean('eligible_for_inventory_discount')->nullable();
            $table->boolean('qualifies_for_inventory_discount')->nullable();
            $table->unique(['tenant_id', 'amazon_store_id', 'ASIN', 'report_date'], 'amazon_monthly_storage_fee_reports_ASIN_report_date');
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
        Schema::dropIfExists('amazon_monthly_storage_fee_reports');
    }
}
