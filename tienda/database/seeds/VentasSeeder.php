<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ventas'); //vaciamos las tablas
        //Datos de prueba
        DB::table('ventas')->insert([
            'articulo_id' => '3',
            'vendedor_id' => '1',
            'unidades' => '7',
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now()  # new \Datetime()
        ]);
        DB::table('ventas')->insert([
            'articulo_id' => '2',
            'vendedor_id' => '2',
            'unidades' => '200',
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now()  # new \Datetime()
        ]);
        DB::table('ventas')->insert([
            'articulo_id' => '6',
            'vendedor_id' => '3',
            'unidades' => '30',
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now()  # new \Datetime()
        ]);
        DB::table('ventas')->insert([
            'articulo_id' => '9',
            'vendedor_id' => '4',
            'unidades' => '8',
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now()  # new \Datetime()
        ]);
        DB::table('ventas')->insert([
            'articulo_id' => '4',
            'vendedor_id' => '5',
            'unidades' => '120',
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now()  # new \Datetime()
        ]);
        DB::table('ventas')->insert([
            'articulo_id' => '9',
            'vendedor_id' => '4',
            'unidades' => '40',
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now()  # new \Datetime()
        ]);
    }
}
