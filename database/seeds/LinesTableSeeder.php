<?php

use Illuminate\Database\Seeder;

class LinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // LÍNEA
        App\Catalogue::create([
            'name' => 'MSI',
            'type_catalog_id' => 4,
            'description' => 'MSI',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'ROWELL',
            'type_catalog_id' => 4,
            'description' => 'ROWELL',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'TRUPER',
            'type_catalog_id' => 4,
            'description' => 'TRUPER',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'NANO CABLE',
            'type_catalog_id' => 4,
            'description' => 'NANO CABLE',
            'state' => 'ACTIVO'
        ]);
    }
}
