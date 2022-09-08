<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forexes', function (Blueprint $table) {
            $table->id();
            $table->string('symbol');
            $table->string('type');
            $table->double('tp');
            $table->double('sl');
            $table->double('lot');
            $table->double('profit')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('forexes');
    }
}
