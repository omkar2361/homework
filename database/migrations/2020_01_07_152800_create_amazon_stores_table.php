<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmazonStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->string('name');
            $table->string('marketplace_id');
            $table->string('merchant_id');
            $table->string('mws_auth_token');
            $table->boolean('is_ads_account_connected')->default(false);
            $table->date('sync_till');
            $table->string('timezone')->default('Asia/Kolkata');

            $table->boolean('is_sponsored_products_connected')->nullable();
            $table->string('currency_code')->nullable();
            $table->string('country_code')->nullable();
            $table->string('profile_id')->nullable();
            $table->double('daily_budget')->nullable();
            $table->text('refresh_token')->nullable();
            $table->text('access_token')->nullable();
            $table->boolean('is_initial_data_fetched')->nullable();

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
        Schema::dropIfExists('amazon_stores');
    }
}
