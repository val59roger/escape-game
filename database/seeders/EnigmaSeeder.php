<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnigmaSeeder extends Seeder
{
    public function run()
    {
        DB::table('enigmas')->insert([
            [
                'scenario_id' => 1,
                'question' => 'Battez l’IA au Pierre-Feuille-Ciseaux.',
                'answer' => 'gagné',
                'hints' => json_encode([
                    'Indice 1 : L’IA choisit souvent "Pierre" en premier.',
                    'Indice 2 : "Ciseaux" est rarement utilisé.',
                    'Indice 3 : Si l’IA a choisi "Feuille", elle choisira "Pierre" au tour suivant.'
                ]),
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'scenario_id' => 2,
                'question' => 'Devinez le nombre entre 1 et 100.',
                'answer' => '42',
                'hints' => json_encode([
                    'Indice 1 : Le nombre est supérieur à 30.',
                    'Indice 2 : Le nombre est un multiple de 7.',
                    'Indice 3 : Le nombre est inférieur à 50.'
                ]),
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'scenario_id' => 3,
                'question' => 'Résolvez l’équation : 12 + 8 + 15 = ?',
                'answer' => '35',
                'hints' => json_encode([
                    'Indice 1 : Additionnez d’abord 12 et 8.',
                    'Indice 2 : Ajoutez ensuite 15 au résultat précédent.',
                    'Indice 3 : Le résultat est supérieur à 30.'
                ]),
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'scenario_id' => 4,
                'question' => 'Trouvez le code du coffre pirate (4 chiffres).',
                'answer' => '1743',
                'hints' => json_encode([
                    'Indice 1 : Le premier chiffre est 1.',
                    'Indice 2 : Le deuxième chiffre est un multiple de 7.',
                    'Indice 3 : Le dernier chiffre est 3.'
                ]),
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'scenario_id' => 5,
                'question' => 'Mélangez les bonnes fioles pour obtenir l’antidote.',
                'answer' => 'Fiole Verte et Fiole Bleue',
                'hints' => json_encode([
                    'Indice 1 : La Fiole Rouge est toxique.',
                    'Indice 2 : La Fiole Bleue est toujours utilisée dans l’antidote.',
                    'Indice 3 : La Fiole Verte neutralise les toxines.'
                ]),
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
