<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('provider');
            $table->string('provider_uid');
            $table->string('email')->nullable();
            $table->decimal('balance', 10, 2)->unsigned()->default(0);
            $table->decimal('score', 10,2)->unsigned()->default(0);
            $table->decimal('hearts', 10, 2)->unsigned()->default(0);
            $table->string('link_o')->nullable();
            $table->text('img')->nullable();
//            $table->tinyInteger('role_id')->default(1);
            $table->tinyInteger('vip')->default(0);
            $table->tinyInteger('ban')->default(0);
            $table->string('password');
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
