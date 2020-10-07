<?php

// namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0; $i<15; $i++){
           Produit::create([
            'libelle'=> $faker->sentence(2),
            'description'=> $faker->sentence(5),
            'prix'=> $faker->numberBetween(1, 100) * 10,
            'qte_stock' => $faker->numberBetween(10, 100),
            'taux_remise' => $faker->numberBetween(1, 50),
            'image'=> 'https://via.placeholder.com/200x250',
            //'id_marque' => $faker->numberBetween(1, 6),
            ])
           ->categories()->attach([
           	rand(1,5),
           	rand(1,5),
           ]);
        }
    }
}
