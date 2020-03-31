<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->string('display_name');
            $table->boolean('is_sub_category')->default(0);
            $table->unsignedBigInteger('parent_id')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_unpaid_balance_required')->default(false);
            $table->boolean('is_unpaid_balance_date_required')->default(false);
            $table->boolean('is_current_balance_required')->default(false);
            $table->boolean('is_current_balance_date_required')->default(false);
            $table->unique(['tenant_id', 'display_name']);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('account_categories', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('account_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_categories');
    }
}
