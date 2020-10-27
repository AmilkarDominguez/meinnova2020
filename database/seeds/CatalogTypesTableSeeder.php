<?php

use Illuminate\Database\Seeder;

class CatalogTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\TypeCatalog::create([
            'name' => 'TIPO',
            'description' => 'Tipo de Productos.',
            'state' => 'ACTIVO'
        ]);
        
        App\TypeCatalog::create([
            'name' => 'ALMACEN',
            'description' => 'Almacen de Productos.',
            'state' => 'ACTIVO'
        ]);

        App\TypeCatalog::create([
            'name' => 'ZONA',
            'description' => 'Zonas de Bolivia.',
            'state' => 'ACTIVO'
        ]);

        App\TypeCatalog::create([
            'name' => 'LINEA',
            'description' => 'linea de Productos.',
            'state' => 'ACTIVO'
        ]);

        App\TypeCatalog::create([
            'name' => 'TIPO CLIENTE',
            'description' => 'Tipos de clientes.',
            'state' => 'ACTIVO'
        ]);
        
        App\TypeCatalog::create([
            'name' => 'INDUSTRIA',
            'description' => 'Industria de Productos.',
            'state' => 'ACTIVO'
        ]);
        ///// duda son necesarios ???
        App\TypeCatalog::create([
            'name' => 'ESTADO PAGO',
            'description' => 'Estados de pagos.',
            'state' => 'ACTIVO'
        ]);
        App\TypeCatalog::create([
            'name' => 'TIPO PAGO',
            'description' => 'Tipo de pago que se utiliza.',
            'state' => 'ACTIVO'
        ]);
    }
}
