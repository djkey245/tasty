<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('class_id');
            $table->string('instanceid');
            $table->string('hash');
            $table->string('title');
            $table->decimal('price',10,2)->nullable();
            $table->integer('lotcase_id');
            $table->string('img');
            $table->string('link');
            $table->string('color')->default('555555');
            $table->string('rarity')->nullable();
            $table->boolean('exist')->default(false);
            $table->boolean('active')->default(true);

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
        Schema::dropIfExists('items');
    }
}
