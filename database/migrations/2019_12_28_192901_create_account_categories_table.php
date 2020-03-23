<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('account_categories')->onDelete('cascade');
            $table->string('name');
            $table->unique(['name', 'parent_id']);
            $table->text('description')->nullable();
            $table->boolean('is_balance_required')->default(false);
            $table->boolean('is_balance_date_required')->default(false);
            $table->boolean('is_unpaid_balance_required')->default(false);
            $table->boolean('is_unpaid_balance_date_required')->default(false);
            $table->boolean('create_account')->default(false);
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
        Schema::dropIfExists('account_categories');
    }
}
