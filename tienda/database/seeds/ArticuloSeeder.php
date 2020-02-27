<?php

use Illuminate\Database\Seeder;
use App\Articulo;
use Illuminate\Support\Facades\DB;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articulos'); //Vaciamos las tablas
        //Datos de prueba
        Articulo::create([
            'nombre'=>'Carmona Microphylla',
            'categoria_id'=>'1',
            'precio'=>'12',
            'stock'=>'2',
            'imagen'=>'/img/articulos/carmona-microphylla.jpg'
        ]);
        Articulo::create([
            'nombre'=>'Absolut Vodka',
            'categoria_id'=>'1',
            'precio'=>'12.20',
            'stock'=>'50',
            'imagen'=>'/img/articulos/absolut-vodka.jpg'
        ]);
        Articulo::create([
            'nombre'=>'Damel Moras',
            'categoria_id'=>'1',
            'precio'=>'3.45',
            'stock'=>'34',
            'imagen'=>'/img/articulos/damel-moras.jpg'
        ]);
        Articulo::create([
            'nombre'=>'Pasion Floral',
            'categoria_id'=>'2',
            'precio'=>'0.95',
            'stock'=>'200',
            'imagen'=>'/img/articulos/pasion-floral.jpg'
        ]);
        Articulo::create([
            'nombre'=>'Taza Elizabeth',
            'categoria_id'=>'2',
            'precio'=>'12.47',
            'stock'=>'5',
            'imagen'=>'/img/articulos/taza-elizabeth-gintama.jpg'
        ]);
        Articulo::create([
            'nombre'=>'Horno de Sobremesa',
            'categoria_id'=>'2',
            'precio'=>'52',
            'stock'=>'17',
            'imagen'=>'/img/articulos/horno-sobremesa.jpg'
        ]);
        Articulo::create([
            'nombre'=>'DeepGaming Havak',
            'categoria_id'=>'3',
            'precio'=>'1384',
            'stock'=>'6',
            'imagen'=>'/img/articulos/deepGaming-havak.jpg'
        ]);
        Articulo::create([
            'nombre'=>'AOC 24G2U/BK',
            'categoria_id'=>'3',
            'precio'=>'189.99',
            'stock'=>'42',
            'imagen'=>'/img/articulos/AOC-24G2U.jpg'
        ]);
        Articulo::create([
            'nombre'=>'Newskill Kitsune',
            'categoria_id'=>'3',
            'precio'=>'139',
            'stock'=>'120',
            'imagen'=>'/img/articulos/newskill-kitsune.jpg'
        ]);
    }
}
