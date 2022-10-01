<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_trajets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trajets_id')->constrained();
            $table->decimal('kilometre_effectue', 8, 2);
            $table->bigInteger('montant_recette');
            $table->bigInteger('montant_carburant');
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
        Schema::dropIfExists('details_trajets');
    }
};
