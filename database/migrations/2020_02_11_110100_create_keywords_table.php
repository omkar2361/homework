<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_keywords', function (Blueprint $table) {
            $table->unsignedBigInteger('keywordId')->index()->primary();
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->unsignedBigInteger('amazon_store_id');
            $table->foreign('amazon_store_id')->references('id')->on('amazon_stores');
            $table->unsignedBigInteger('adGroupId');
            $table->foreign('adGroupId')->references('adGroupId')->on('amazon_ad_groups')->onDelete('cascade');
            $table->unsignedBigInteger('campaignId');
            $table->foreign('campaignId')->references('campaignId')->on('amazon_campaigns')->onDelete('cascade');
            $table->string('keywordText')->nullable();
            $table->string('matchType')->nullable();
            $table->string('state')->nullable();
            $table->string('servingStatus')->nullable();
            $table->string('creationDate')->nullable();
            $table->string('lastUpdatedDate')->nullable();
            $table->unique(['amazon_store_id', 'tenant_id', 'keywordId']);
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
        Schema::dropIfExists('amazon_keywords');
    }
}
