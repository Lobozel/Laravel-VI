<?php

use Illuminate\Database\Seeder;
use App\Vendedor;
use Illuminate\Support\Facades\DB;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendedores'); //Vaciamos las tablas
        //Datos de prueba
        Vendedor::create([
            'nombre'=>'David',
            'apellidos'=>'Arango Fraguas',
            'email'=>'david.arango@gmail.com',
            'direccion'=>'Paseo Lorem, 18B 12E',
            'telefono'=>'663 691 837',
            'foto'=>'/img/vendedores/david.jpg'
        ]);
        Vendedor::create([
            'nombre'=>'Angel Esteban',
            'apellidos'=>'Cervero Baranda',
            'email'=>'angel.esteban_92@gmail.com',
            'direccion'=>'Cañada Lorem ipsum, 138A 11D',
            'telefono'=>'776 652 823',
            'foto'=>'/img/vendedores/angel-esteban.jpg'
        ]);
        Vendedor::create([
            'nombre'=>'Enrica',
            'apellidos'=>'Canto Cortijo',
            'email'=>'cc75@gmail.com',
            'direccion'=>'Pasaje Lorem ipsum dolor sit, 192 2B',
            'telefono'=>'799 741 661',
            'foto'=>'/img/vendedores/enrica.jpg'
        ]);
        Vendedor::create([
            'nombre'=>'Javier',
            'apellidos'=>'Mondragon',
            'email'=>'blackdragon.javi@gmail.com',
            'direccion'=>'Glorieta Lorem, 9A',
            'telefono'=>'676 030 653',
            'foto'=>'/img/vendedores/javier.jpg'
        ]);
        Vendedor::create([
            'nombre'=>'Maria Stella',
            'apellidos'=>'Maroto Azpiroz',
            'email'=>'maroto-azpiroz.maria@gmail.com',
            'direccion'=>'Pasadizo Lorem ipsum dolor sit, 44',
            'telefono'=>'662 602 208',
            'foto'=>'/img/vendedores/maria-stella.jpg'
        ]);
    }
}
