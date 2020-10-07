<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle');
            $table->string('description');
            $table->float('prix');
            $table->float('qte_stock');
            $table->float('taux_remise')->nullable();
            $table->string('image');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('id_marque')->nullable();
            $table->foreign('id_marque')
                  ->references('id')
                  ->on('marques')
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
        Schema::dropIfExists('produits');
    }
}
