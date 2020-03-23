<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('amazon_keyword_reports');
        Schema::create('amazon_keyword_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->unsignedBigInteger('amazon_store_id');
            $table->foreign('amazon_store_id')->references('id')->on('amazon_stores');
            $table->unsignedBigInteger('keywordId')->nullable();
            $table->foreign('keywordId')->references('keywordId')->on('amazon_keywords')->onDelete('cascade');
            $table->double('cost')->nullable();
            $table->unsignedBigInteger('campaignId')->nullable();
            $table->foreign('campaignId')->references('campaignId')->on('amazon_campaigns')->onDelete('cascade');
            $table->string('matchType')->nullable();
            $table->unsignedBigInteger('attributedSales14dSameSKU')->nullable();
            $table->unsignedBigInteger('impressions')->nullable();
            $table->unsignedBigInteger('adGroupId')->nullable();
            $table->string('keywordText')->nullable();
            $table->unsignedBigInteger('attributedConversions14d')->nullable();
            $table->unsignedBigInteger('attributedConversions14dSameSKU')->nullable();
            $table->unsignedBigInteger('clicks')->nullable();
            $table->unsignedBigInteger('attributedSales14d')->nullable();
            $table->string('campaignName')->nullable();
            $table->date('report_date');
            $table->unique(['amazon_store_id', 'tenant_id', 'report_date', 'keywordId'], 'amazon_keyword_reports_keywordId_report_date');
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
        Schema::dropIfExists('amazon_keyword_reports');
    }
}
