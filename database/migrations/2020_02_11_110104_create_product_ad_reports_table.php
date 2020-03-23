<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAdReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('amazon_product_ad_reports');
        Schema::create('amazon_product_ad_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->unsignedBigInteger('amazon_store_id');
            $table->foreign('amazon_store_id')->references('id')->on('amazon_stores');
            $table->integer('attributedSales7d')->nullable();
            $table->integer('attributedSales30d')->nullable();
            $table->integer('attributedUnitsOrdered30d')->nullable();
            $table->integer('attributedSales1d')->nullable();
            $table->integer('attributedConversions1d')->nullable();
            $table->integer('attributedSales1dSameSKU');
            $table->integer('attributedConversions30d')->nullable();
            $table->integer('adGroupId')->nullable();
            $table->integer('attributedConversions7d')->nullable();
            $table->integer('attributedConversions14d')->nullable();
            $table->string('currency')->nullable();
            $table->string('sku')->nullable();
            $table->integer('attributedConversions7dSameSKU')->nullable();
            $table->integer('attributedConversions1dSameSKU')->nullable();
            $table->double('cost')->nullable();
            $table->string('adGroupName')->nullable();
            $table->integer('attributedUnitsOrdered7d')->nullable();
            $table->integer('attributedSales7dSameSKU')->nullable();
            $table->unsignedBigInteger('campaignId')->nullable();
            $table->foreign('campaignId')->references('campaignId')->on('amazon_campaigns')->onDelete('cascade');
            $table->integer('attributedSales14dSameSKU')->nullable();
            $table->integer('attributedSales30dSameSKU')->nullable();
            $table->integer('impressions')->nullable();
            $table->integer('attributedUnitsOrdered1d')->nullable();
            $table->integer('attributedConversions30dSameSKU')->nullable();
            $table->unsignedBigInteger('adId')->unique();
            $table->integer('attributedConversions14dSameSKU')->nullable();
            $table->integer('clicks')->nullable();
            $table->string('asin')->nullable();
            $table->integer('attributedSales14d')->nullable();
            $table->string('campaignName')->nullable();
            $table->integer('attributedUnitsOrdered14d')->nullable();
            $table->date('report_date');
            $table->unique(['amazon_store_id', 'tenant_id', 'report_date', 'adGroupId'], 'amazon_product_ad_reports_adGroupId_report_date');
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
        Schema::dropIfExists('amazon_product_ad_reports');
    }
}
