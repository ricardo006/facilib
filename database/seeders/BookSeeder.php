<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Genre;

use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $genres = Genre::all();

        if ($genres->isEmpty()) {
            $genre = Genre::create([
                "name"=> 'Ficcão',
            ]);
            $genres = Genre::all();
        }

        foreach (range(1,50) as $index) {
            Book::create([
                'nome' => $faker->sentence(3),
                'autor' => $faker->name, // Autor
                'numero_registro' => $faker->unique()->numerify('#######'), // Número de registro único
                'situacao' => 'Disponível', // Situação inicial
                'genero_id' => $genres->random()->id,
            ]);
        }
    }
}
