<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResponsibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $responsibilities = [
            ['name' => 'Prefeito', 'is_active' => 1],
            ['name' => 'Vice-Prefeito', 'is_active' => 1],
            ['name' => 'Chefe do Gabinete', 'is_active' => 1],
            ['name' => 'Procuradora Geral do Município', 'is_active' => 1],
            ['name' => 'Procurador Adjunto do Município', 'is_active' => 1],
            ['name' => 'Controlador Geral', 'is_active' => 1],
            ['name' => 'Controladora Adjunta', 'is_active' => 1],
            ['name' => 'Presidente', 'is_active' => 1],
            ['name' => 'Vice-Presidente', 'is_active' => 1],
            ['name' => 'Secretária', 'is_active' => 1],
            ['name' => 'Secretário', 'is_active' => 1],
            ['name' => 'Adjunta', 'is_active' => 1],
            ['name' => 'Adjunto', 'is_active' => 1],
            ['name' => 'Chefia de Gabinete', 'is_active' => 1],
        ];

        foreach ($responsibilities as $item) {
            \App\Models\Responsibility::Create($item);
        }
    }
}
