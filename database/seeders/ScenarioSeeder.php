<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Scenario;

class ScenarioSeeder extends Seeder
{
    public function run()
    {
        Scenario::insert([
            ['title' => 'Le Mystère du Château Oublié', 'description' => 'Échappez-vous du château hanté !', 'difficulty' => 'easy'],
            ['title' => 'Le Bureau du Hacker', 'description' => 'Retrouvez les données avant qu’elles ne s’effacent !', 'difficulty' => 'medium'],
            ['title' => 'Station Spatiale en Péril', 'description' => 'Réparez la station avant la panne d’oxygène !', 'difficulty' => 'hard'],
            ['title' => 'Le Musée Maudit', 'description' => 'Levez la malédiction de l’ancienne Égypte.', 'difficulty' => 'medium'],
            ['title' => 'Le Laboratoire du Docteur X', 'description' => 'Synthétisez l’antidote avant qu’il ne soit trop tard.', 'difficulty' => 'hard'],
        ]);
    }
}
