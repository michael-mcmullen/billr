<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('company_id');
            $table->decimal('amount', 12, 2);
            $table->date('received');
            $table->date('due');
            $table->boolean('paid')->default(0);
            $table->decimal('paid_amount', 12, 2)->nullable();
            $table->date('paid_date')->nullable();
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
        Schema::drop('bills');
    }
}
