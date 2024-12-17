<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Ficção',
            'Romance',
            'Fantasia',
            'Aventura',
            'Mistério',
            'Terror',
            'Histórico',
            'Ficcção científica',
            'Biografia',
            'Drama',
            'Comédia',
            'Crime',
            'Psicológico',
            'Fábulas',
            'Paranormal',
            'Suspense',
            'Policial',
            'Espionagem',
            'Literatura infanto-juvenil',
            'Teatro',
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'nome' => $genre,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
