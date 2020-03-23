<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_campaigns', function (Blueprint $table) {
            $table->unsignedBigInteger('campaignId')->index()->unique()->primary();
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->unsignedBigInteger('amazon_store_id');
            $table->foreign('amazon_store_id')->references('id')->on('amazon_stores');
            $table->string('name')->nullable();
            $table->string('campaignType')->nullable();
            $table->string('targetingType')->nullable();
            $table->boolean('premiumBidAdjustment')->nullable();
            $table->double('dailyBudget')->nullable();
            $table->string('startDate')->nullable();
            $table->string('state')->nullable();
            $table->jsonb('bidding')->nullable();
            $table->string('servingStatus')->nullable();
            $table->string('creationDate')->nullable();
            $table->string('lastUpdatedDate');
            $table->unique(['amazon_store_id', 'tenant_id', 'campaignId']);
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
        Schema::dropIfExists('amazon_campaigns');
    }
}
