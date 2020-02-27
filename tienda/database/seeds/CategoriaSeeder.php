<?php

use Illuminate\Database\Seeder;
use App\Categoria;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias'); //Vaciamos las tablas
        //Datos de prueba
        Categoria::create([
            'nombre'=>'Bazar',
            'descripcion'=>'Productos varios que podrias encontrar en un bazar.',
            'logo'=>'/img/categorias/bazar.jpg'
        ]);
        Categoria::create([
            'nombre'=>'Hogar',
            'descripcion'=>'Todo lo necesario para tu hogar y tu confort.',
            'logo'=>'/img/categorias/hogar.jpg'
        ]);
        Categoria::create([
            'nombre'=>'Electrónica',
            'descripcion'=>'Aquí encontrarás diferentes dispositivos electrónicos de toda clase.',
            'logo'=>'/img/categorias/electronica.jpg'
        ]);
    }
}
