<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned()->index();
            $table->integer('user_id')->unsigned();
            $table->string('price_agreed')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('commission_percentage')->nullable();
            $table->string('commission_deductable')->nullable();
            $table->string('consumption_tax')->nullable();
            $table->string('price_payable')->nullable();
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
        Schema::dropIfExists('bid_companies');
    }
}
