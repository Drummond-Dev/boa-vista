<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            ['title' => 'Início', 'parent_id' => 0, 'sort_order' => 0, 'slug' => 'home'],
            ['title' => 'Prefeitura', 'parent_id' => 0, 'sort_order' => 1, 'slug' => 'prefeitura'],
            ['title' => 'Notícias', 'parent_id' => 0, 'sort_order' => 2, 'slug' => 'noticias'],
            ['title' => 'Concursos e Seletivos', 'parent_id' => 0, 'sort_order' => 3, 'slug' => 'concursos-e-seletivos'],
            ['title' => 'Canais', 'parent_id' => 0, 'sort_order' => 4, 'slug' => 'canais'],
            ['title' => 'Publicações', 'parent_id' => 0, 'sort_order' => 5, 'slug' => 'publicacoes'],
            ['title' => 'Transparências', 'parent_id' => 0, 'sort_order' => 6, 'slug' => 'transparencia'],
            ['title' => 'Multimídia', 'parent_id' => 0, 'sort_order' => 7, 'slug' => 'multimidia'],
            ['title' => 'Portal do Cidadão', 'parent_id' => 0, 'sort_order' => 8, 'slug' => 'portal-do-cidadao'],
            ['title' => 'Observatório', 'parent_id' => 0, 'sort_order' => 9, 'slug' => 'observatorio'],
        ];
        foreach ($menus as $menu) {
            \App\Models\Menu::Create($menu);
        }
    }
}
