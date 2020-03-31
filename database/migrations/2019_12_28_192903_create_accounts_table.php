<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->integer('account_category_id')->unsigned();
            $table->string('name');
            $table->boolean('is_sub_account')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->date('unpaid_balance_date')->nullable();
            $table->double('unpaid_balance')->nullable();
            $table->string('description')->nullable();
            $table->enum('account_type', ['Carry Forward', 'Not Carry Forward', 'Other'])->nullable();
            $table->enum('account_sub_type', ['Carry Forward', 'Not Carry Forward', 'Other'])->nullable();
            $table->string('account_number')->nullable();
            $table->double('current_balance')->nullable();
            $table->date('current_balance_date')->nullable();
            $table->integer('tax_id')->unsigned()->nullable(); //Remove nullable
            $table->foreign('tax_id')->references('id')->on('taxes');
            $table->enum('type', ['Report', 'Register'])->nullable();
            $table->unique(['tenant_id', 'name']);
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
        Schema::dropIfExists('accounts');
    }
}
