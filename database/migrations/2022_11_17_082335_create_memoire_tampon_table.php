<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemoireTamponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memoire_tampon', function (Blueprint $table) {
            $table->id();
            $table->string('localite');
            $table->string('operateur');
            $table->string('demandeur');
            $table->string('technologie');
            $table->integer('presence');
            $table->integer('couverture');
            $table->integer('population_couverte');
            $table->integer('population_totale');
            $table->integer('statut');
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
        Schema::dropIfExists('memoire_tampon');
    }
}
