<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorieProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_produit', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('categorie_id');
            $table->foreign('categorie_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('produit_id')->nullable();
            $table->foreign('produit_id')
                  ->references('id')
                  ->on('produits')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('categorie_produit');
    }
}
