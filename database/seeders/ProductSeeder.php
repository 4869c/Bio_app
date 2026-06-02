<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Pommes Bio',           'category' => 'Fruits',            'price' => 3.50, 'quantity' => 50, 'description' => 'Pommes biologiques fraîches de notre ferme.'],
            ['name' => 'Tomates Bio',          'category' => 'Légumes',           'price' => 2.20, 'quantity' => 80, 'description' => 'Tomates biologiques juteuses et savoureuses.'],
            ['name' => 'Lait Fermier 1L',      'category' => 'Produits laitiers', 'price' => 1.80, 'quantity' => 40, 'description' => 'Lait entier frais provenant directement de la ferme.'],
            ['name' => 'Miel Pur 500g',        'category' => 'Miel',              'price' => 8.00, 'quantity' => 30, 'description' => 'Miel naturel pur, brut et non filtré.'],
            ['name' => 'Basilic Frais',        'category' => 'Herbes',            'price' => 1.50, 'quantity' => 25, 'description' => 'Feuilles de basilic aromatiques et fraîches.'],
            ['name' => 'Carottes Bio',         'category' => 'Légumes',           'price' => 1.90, 'quantity' => 60, 'description' => 'Carottes biologiques sucrées et croquantes.'],
            ['name' => 'Oranges Fraîches',     'category' => 'Fruits',            'price' => 2.80, 'quantity' => 70, 'description' => 'Oranges mûries au soleil, riches en vitamines.'],
            ['name' => 'Fromage Fermier',      'category' => 'Produits laitiers', 'price' => 6.50, 'quantity' => 20, 'description' => 'Fromage artisanal fait à la ferme.'],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['name' => $p['name']], $p);
        }
    }
}
