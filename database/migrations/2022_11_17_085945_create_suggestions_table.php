<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();
            $table->string('operateur')->nullable();
            $table->string('localite')->nullable();
            $table->integer('connexion_lente')->nullable();
            $table->integer('connexion_impossible')->nullable();
            $table->integer('appel_non_fluide')->nullable();
            $table->integer('appel_impossible')->nullable();
            $table->integer('envoi_sms_lent')->nullable();
            $table->integer('reception_sms_lente')->nullable();
            $table->integer('envoi_sms_impossible')->nullable();
            $table->integer('reception_sms_impossible')->nullable();
            $table->integer('application_lent')->nullable();
            $table->integer('probleme_affichage')->nullable();
            $table->text('commentaire')->nullable();
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
        Schema::dropIfExists('suggestions');
    }
}
