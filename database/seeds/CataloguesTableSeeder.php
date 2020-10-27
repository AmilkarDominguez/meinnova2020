<?php

use Illuminate\Database\Seeder;

class CataloguesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TIPO DE PRODUCTO
        App\Catalogue::create([
            'name' => 'MEDICAMENTO',
            'type_catalog_id'=>1,
            'description' => 'TIPO DE PRODUCTO MEDICAMENTO.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'INSUMO',
            'type_catalog_id'=>1,
            'description' => 'TIPO DE PRODUCTO INSUMO.',
            'state' => 'ACTIVO'
        ]);



        //TIPO DE CLIENTE
        App\Catalogue::create([
            'name' => 'MINORISTA',
            'type_catalog_id'=>5,
            'description' => 'TIPO DE CLIENTE MINORISTA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'MAYORISTA',
            'type_catalog_id'=>5,
            'description' => 'TIPO DE CLIENTE MAYORISTA.',
            'state' => 'ACTIVO'
        ]);


        // ESTADO DE PAGO
        App\Catalogue::create([
            'name' => 'PENDIENTE',
            'type_catalog_id'=>7,
            'description' => 'ESTADO DE PAGO PENDIENTE.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'CANCELADO',
            'type_catalog_id'=>7,
            'description' => 'ESTADO DE PAGO CANCELADO.',
            'state' => 'ACTIVO'
        ]);


        //TIPO DE PAGO
        App\Catalogue::create([
            'name' => 'CRÉDITO',
            'type_catalog_id'=>8,
            'description' => 'TIPO DE PAGO CRÉDITO.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'DÉBITO',
            'type_catalog_id'=>8,
            'description' => 'TIPO DE PAGO DÉBITO.',
            'state' => 'ACTIVO'
        ]);

        //ALMACENES

        //INDUSTRIAS
        App\Catalogue::create([
            'name' => 'BOLIVIA',
            'type_catalog_id'=>6,
            'description' => 'BOLIVIA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'ARGENTINA',
            'type_catalog_id'=>6,
            'description' => 'ARGENTINA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'CHILE',
            'type_catalog_id'=>6,
            'description' => 'CHILE.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'BRASIL',
            'type_catalog_id'=>6,
            'description' => 'BRASIL.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'PARAGUAY',
            'type_catalog_id'=>6,
            'description' => 'PARAGUAY.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'URUGUAY',
            'type_catalog_id'=>6,
            'description' => 'URUGUAY.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'COLOMBIA',
            'type_catalog_id'=>6,
            'description' => 'COLOMBIA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'VENEZUELA',
            'type_catalog_id'=>6,
            'description' => 'VENEZUELA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'ECUADOR',
            'type_catalog_id'=>6,
            'description' => 'ECUADOR.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'PERU',
            'type_catalog_id'=>6,
            'description' => 'PERU.',
            'state' => 'ACTIVO'
        ]);

        
        //ZONAS

        App\Catalogue::create([
            'name' => 'TARIJA',
            'type_catalog_id'=>3,
            'description' => 'TARIJA DEPARTAMENTO DE BOLIVIA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'SUCRE',
            'type_catalog_id'=>3,
            'description' => 'SUCRE DEPARTAMENTO DE BOLIVIA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'SANTA CRUZ',
            'type_catalog_id'=>3,
            'description' => 'SANTA CRUZ DEPARTAMENTO DE BOLIVIA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'POTOSI',
            'type_catalog_id'=>3,
            'description' => 'POTOSI DEPARTAMENTO DE BOLIVIA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'ORURO',
            'type_catalog_id'=>3,
            'description' => 'ORURO DEPARTAMENTO DE BOLIVIA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'PANDO',
            'type_catalog_id'=>3,
            'description' => 'PANDO DEPARTAMENTO DE BOLIVIA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'LA PAZ',
            'type_catalog_id'=>3,
            'description' => 'LA PAZ DEPARTAMENTO DE BOLIVIA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'COCHABAMBA',
            'type_catalog_id'=>3,
            'description' => 'COCHABAMBA DEPARTAMENTO DE BOLIVIA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'BENI',
            'type_catalog_id'=>3,
            'description' => 'BENI DEPARTAMENTO DE BOLIVIA.',
            'state' => 'ACTIVO'
        ]);

        App\Catalogue::create([
            'name' => 'VILLAMONTES-TARIJA',
            'type_catalog_id'=>3,
            'description' => 'ZONA DE TARIJA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'BERMEJO-TARIJA',
            'type_catalog_id'=>3,
            'description' => 'ZONA DE TARIJA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'CAMIRI-TARIJA',
            'type_catalog_id'=>3,
            'description' => 'ZONA DE TARIJA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'VILLAZON-POTOSI',
            'type_catalog_id'=>3,
            'description' => 'ZONA DE POTOSI.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'TUPIZA-POTOSI',
            'type_catalog_id'=>3,
            'description' => 'ZONA DE POTOSI.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'CAMARGO-SUCRE',
            'type_catalog_id'=>3,
            'description' => 'ZONA DE SUCRE.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'UYUNI-POTOSI',
            'type_catalog_id'=>3,
            'description' => 'ZONA DE POTOSI.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'YACUIBA-TARIJA',
            'type_catalog_id'=>3,
            'description' => 'ZONA DE TARIJA.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'ENTRE RIOS-TARIJA',
            'type_catalog_id'=>3,
            'description' => 'ZONA DE TARIJA.',
            'state' => 'ACTIVO'
        ]);
        // ALMACÉN
        App\Catalogue::create([
            'name' => 'ALMACÉN PRINCIPAL',
            'type_catalog_id'=>2,
            'description' => 'ALMACÉN PRINCIPA.',
            'state' => 'ACTIVO'
        ]);

        
        
    }
}
