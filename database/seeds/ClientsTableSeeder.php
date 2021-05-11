<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CLIENTE

        App\Client::create(
            [
                'name' => 'CARLOS TAPIA',
                'address' => '',
                'phone' => '',
                'catalog_zone_id' => 29,
                'contact' => '',
                'description' => '',
                'nit' => '101010',
                'state' => 'ACTIVO'
            ]
        );
        App\Client::create(
            [
                'name' => 'MARIA FLORES',
                'address' => '',
                'phone' => '',
                'catalog_zone_id' => 29,
                'contact' => '',
                'description' => '',
                'nit' => '202020',
                'state' => 'ACTIVO'
            ]
        );
        App\Client::create(
            [
                'name' => 'JAVIER LLANOS',
                'address' => '',
                'phone' => '',
                'catalog_zone_id' => 29,
                'contact' => '',
                'description' => '',
                'nit' => '303030',
                'state' => 'ACTIVO'
            ]
        );
    }
}
