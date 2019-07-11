<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('account_no')->nullable();
            $table->unsignedInteger('collector_id');
            $table->unsignedInteger('total_loan');
            $table->date('date_loaned');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('amount_loaned');
            $table->date('due_date');
            $table->unsignedInteger('daily_payment');
            $table->string('loan_term');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
