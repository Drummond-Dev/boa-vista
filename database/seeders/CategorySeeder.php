<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Assistência Social', 'slug' => 'assistencia-social', 'parent_id' => 0],
            ['name' => 'Cidadania', 'slug' => 'cidadania', 'parent_id' => 0],
            ['name' => 'Cultura', 'slug' => 'cultura', 'parent_id' => 0],
            ['name' => 'Educação', 'slug' => 'educacao', 'parent_id' => 0],
            ['name' => 'Economia', 'slug' => 'economia', 'parent_id' => 0],
            ['name' => 'Emprego e Renda', 'slug' => 'emprego-e-renda', 'parent_id' => 0],
            ['name' => 'Esporte', 'slug' => 'esporte', 'parent_id' => 0],
            ['name' => 'Habitação', 'slug' => 'habitacao', 'parent_id' => 0],
            ['name' => 'Impostos', 'slug' => 'impostos', 'parent_id' => 0],
            ['name' => 'Infraestrutura', 'slug' => 'infraestrutura', 'parent_id' => 0],
            ['name' => 'Meio Ambiente', 'slug' => 'meio-ambiente', 'parent_id' => 0],
            ['name' => 'Orçamento', 'slug' => 'orcamento', 'parent_id' => 0],
            ['name' => 'Patrulha da CHuva', 'slug' => 'patrulah-da-chuva', 'parent_id' => 0],
            ['name' => 'Poluição Visual', 'slug' => 'poluicao-visual', 'parent_id' => 0],
            ['name' => 'Saúde', 'slug' => 'saude', 'parent_id' => 0],
            ['name' => 'Segurança', 'slug' => 'seguranca', 'parent_id' => 0],
            ['name' => 'Serviços Públicos', 'slug' => 'servicos-publicos', 'parent_id' => 0],
            ['name' => 'Social', 'slug' => 'social', 'parent_id' => 0],
            ['name' => 'Servidor', 'slug' => 'servidor', 'parent_id' => 0],
            ['name' => 'Tecnologia', 'slug' => 'tecnologia', 'parent_id' => 0],
            ['name' => 'Transporte Urbano', 'slug' => 'transporte-urbano', 'parent_id' => 0],
            ['name' => 'Trânsito', 'slug' => 'transito', 'parent_id' => 0],
            ['name' => 'Turismo', 'slug' => 'turismo', 'parent_id' => 0],
        ];

        foreach($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
