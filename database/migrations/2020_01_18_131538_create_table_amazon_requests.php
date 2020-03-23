<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAmazonRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->unsignedBigInteger('amazon_store_id');
            $table->foreign('amazon_store_id')->references('id')->on('amazon_stores');
            $table->string('report_request_id')->nullable();
            $table->string('report_id')->nullable();
            $table->string('type');
            $table->string('sub_type');
            $table->dateTimeTz('start');
            $table->dateTimeTz('end');
            $table->enum('portal', ['MWS', 'ADS'])->default('MWS');
            $table->string('filename')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('amazon_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('amazon_request_id');
            $table->foreign('amazon_request_id')->references('id')->on('amazon_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amazon_requests');
    }
}
