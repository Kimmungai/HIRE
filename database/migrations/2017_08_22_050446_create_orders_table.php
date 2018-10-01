<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('bid_status')->default(0);
            $table->string('order_name')->nullable();
            $table->string('pick_up_date')->nullable();
            $table->string('pick_up_time')->nullable();
            $table->string('pick_up_address')->nullable();
            $table->string('drop_off_date')->nullable();
            $table->string('drop_off_time')->nullable();
            $table->string('drop_off_address')->nullable();
            $table->integer('num_of_cars')->unsigned();
            $table->integer('number_of_people')->unsigned();
            $table->string('luggage_num')->nullable();
            $table->string('car_type')->nullable();
            $table->text('journey')->nullable();
            $table->longText('remarks')->nullable();
            $table->integer('bid_id')->unsigned()->index();
            $table->integer('admin_approved')->default(0);
            $table->integer('suspended')->default(0);
            $table->string('deadline-date')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
