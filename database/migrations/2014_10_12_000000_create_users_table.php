<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name')->nullable();
            $table->string('company_type')->default(0);
            $table->string('company_name_furigana')->nullable();
            $table->string('first_name')->nullable();
            $table->string('first_name_furigana')->nullable();
            $table->string('last_name')->nullable();
            $table->string('last_name_furigana')->nullable();
            $table->string('zip')->nullable();
            $table->string('address')->nullable();
            $table->string('tel')->nullable();
            $table->string('email')->unique();
            $table->string('password')->default(bcrypt(''));
            $table->tinyInteger('verified')->default(0);
            $table->tinyInteger('user_category');
            $table->string('email_token')->index()->nullable();
            $table->boolean('is_admin')->default(0);
            $table->integer('admin_approved')->default(0);
            $table->tinyInteger('online_status')->default(0);
            $table->string('last_login')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
