<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAccountCategoryChangeType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_categories', function (Blueprint $table) {
            // $table->unsignedBigInteger('parent_id')->nullable()->change();
            // $table->string('type')->nullable()->change();
            // $table->string('sub_type')->nullable()->change();
            // $table->text('description')->nullable()->change();
            // $table->boolean('is_balance_required')->nullable()->change();
            // $table->boolean('is_unpaid_balance_required')->nullable()->change();
            // $table->boolean('unpaid_balance_date_required')->nullable()->after('is_unpaid_balance_required');
            // $table->boolean('balance_date_required')->nullable()->after('is_balance_required');
            // $table->boolean('is_subcategory')->nullable()->after('type');
            // $table->boolean('create_account')->nullable()->after('unpaid_balance_date_required');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
