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
            'name' => 'LABORATORIOS VALENCIA',
            'type_catalog_id'=>4,
            'description' => 'LABORATORIOS VALENCIA.',
            'state' => 'ACTIVO'
        ]);

        App\Catalogue::create([
            'name' => 'OTROS',
            'type_catalog_id'=>4,
            'description' => 'OTROS.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'FITOBOL LTDA.',
            'type_catalog_id'=>4,
            'description' => 'FITOBOL LTDA.',
            'state' => 'ACTIVO'
        ]);

        App\Catalogue::create([
            'name' => 'UNIBIOS',
            'type_catalog_id'=>4,
            'description' => 'UNIBIOS.',
            'state' => 'ACTIVO'
        ]);

        App\Catalogue::create([
            'name' => 'INTERMEDICAL',
            'type_catalog_id'=>4,
            'description' => 'INTERMEDICAL.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'BIOMEDICAL',
            'type_catalog_id'=>4,
            'description' => 'BIOMEDICAL.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'MHEDICAL PHARMA SRL.',
            'type_catalog_id'=>4,
            'description' => 'MHEDICAL PHARMA SRL.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'TELCHI',
            'type_catalog_id'=>4,
            'description' => 'TELCHI.',
            'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
        'name' => 'PROTEX',
        'type_catalog_id'=>4,
        'description' => 'PROTEX.',
        'state' => 'ACTIVO'
        ]);
        App\Catalogue::create([
            'name' => 'THAIS',
            'type_catalog_id'=>4,
            'description' => 'THAIS.',
            'state' => 'ACTIVO'
        ]);
    }
}
