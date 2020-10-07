<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Categorie::create([
    		'name' => "Livres",
    		'slug' => "livres",
    	]);

    	Categorie::create([
    		'name' => "high tech",
    		'slug' => "high-tech",
    	]);

    	Categorie::create([
    		'name' => "Meuble",
    		'slug' => "meuble",
    	]);

    	Categorie::create([
    		'name' => "Ordinateurs",
    		'slug' => "ordinateurs",
    	]);

    	Categorie::create([
    		'name' => "Vêtements",
    		'slug' => "vêtements",
    	]);

    	Categorie::create([
    		'name' => "Nourriture",
    		'slug' => "nourriture",
    	]);
    }
}
