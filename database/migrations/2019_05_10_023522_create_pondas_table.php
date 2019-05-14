<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePondasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pondas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->text('introduction');
            $table->integer('score')->nullable();
            $table->timestamps();
        });
        Schema::create('UID', function (Blueprint $table) {
            $table->string('UID', 10);
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
        Schema::dropIfExists('pondas');
    }
}
