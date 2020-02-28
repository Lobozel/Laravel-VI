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
            'descripcion'=>'Situación: en zonas de clima mediterráneo puede vivir al exterior durante los meses de verano, el resto del año proteger del frío. En zonas mas frías, debe situarse todo el año en invernadero.',
            'categoria_id'=>'1',
            'precio'=>'12',
            'stock'=>'2',
            'imagen'=>'/img/articulos/carmona-microphylla.jpg'
        ]);
        Articulo::create([
            'nombre'=>'Absolut Vodka',
            'descripcion'=>'Absolut Vodka se elabora exclusivamente a partir de ingredientes naturales, principalmente de agua y trigo de invierno de Ahus, y sin azúcar añadido.',
            'categoria_id'=>'1',
            'precio'=>'12.20',
            'stock'=>'0',
            'imagen'=>'/img/articulos/absolut-vodka.jpg'
        ]);
        Articulo::create([
            'nombre'=>'Damel Moras',
            'descripcion'=>'1 kilogramos',
            'categoria_id'=>'1',
            'precio'=>'3.45',
            'stock'=>'34',
            'imagen'=>'/img/articulos/damel-moras.jpg'
        ]);
        Articulo::create([
            'nombre'=>'Pasion Floral',
            'descripcion'=>'Huele a Pasion Floral.',
            'categoria_id'=>'2',
            'precio'=>'0.95',
            'stock'=>'200',
            'imagen'=>'/img/articulos/pasion-floral.jpg'
        ]);
        Articulo::create([
            'nombre'=>'Taza Elizabeth',
            'descripcion'=>'Diseño grueso y antideslizante en la parte inferior de la copa.',
            'categoria_id'=>'2',
            'precio'=>'12.47',
            'stock'=>'5',
            'imagen'=>'/img/articulos/taza-elizabeth-gintama.jpg'
        ]);
        Articulo::create([
            'nombre'=>'Horno de Sobremesa',
            'descripcion'=>'Hecho de materiales de alta calidad, duraderos, seguros y no tóxicos, prácticos.',
            'categoria_id'=>'2',
            'precio'=>'52',
            'stock'=>'17',
            'imagen'=>'/img/articulos/horno-sobremesa.jpg'
        ]);
        Articulo::create([
            'nombre'=>'DeepGaming Havak',
            'descripcion'=>'Havak es un completo y potente pc gaming de sobremesa.',
            'categoria_id'=>'3',
            'precio'=>'1384',
            'stock'=>'6',
            'imagen'=>'/img/articulos/deepGaming-havak.jpg'
        ]);
        Articulo::create([
            'nombre'=>'AOC 24G2U/BK',
            'descripcion'=>'Resolución 1920x1080 px tasa de refresco 144hz tiempo de respuesta.',
            'categoria_id'=>'3',
            'precio'=>'189.99',
            'stock'=>'42',
            'imagen'=>'/img/articulos/AOC-24G2U.jpg'
        ]);
        Articulo::create([
            'nombre'=>'Newskill Kitsune',
            'descripcion'=>'Su diseño ergonómico hace que KITSUNE se ajuste a las curvaturas naturales de la espalda, proporcionándote una sensación de máximo confort.',
            'categoria_id'=>'3',
            'precio'=>'139',
            'stock'=>'120',
            'imagen'=>'/img/articulos/newskill-kitsune.jpg'
        ]);
    }
}
