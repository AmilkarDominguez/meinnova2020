<?php

use Illuminate\Database\Seeder;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // PRODUCTO
        App\Product::create([
            'name' => 'ASPIRINA PRUEBA 100 gr.',
            'catalog_product_id'=>1,
            'description' => 'DESCRIPCIÓN ASPIRINA PRUEBA 100 gr.',
            'state' => 'ACTIVO'
        ]); 
        App\Product::create([
            'name' => 'JARABE PARA LA TOS 100 ml.',
            'catalog_product_id'=>1,
            'description' => 'JARABE PARA LA TOS.',
            'state' => 'ACTIVO'
        ]);
        // PROVEEDOR
        App\Provider::create([
            'name' => 'PROVEEDOR 1',
            'catalog_zone_id'=>3,
            'description' => 'DESCRIPCIÓN PROVEEDOR 1.',
            'contact' => 'GABRIELA',
            'phone' => '4567891',
            'address' => 'AV. TARIJA NRO. 225',
            'state' => 'ACTIVO'
        ]);
        // CLIENTE
        App\Client::create([
            'catalog_zone_id'=>10,
            'nit' => 7159779,
            'name' => 'FARMACENTER',
            'contact'=>'CARLOS SANBRANA',
            'description' => 'CLIENTE DE TARIJA.',
            'phone' => '72954379',
            'address' => 'AEROPUERTO',
            'state' => 'ACTIVO'
        ]);
        // VENDEDOR
        App\Seller::create([
            'name' => 'SR. VENDEDOR 1',
            'description' => 'SR. VENDEDOR 1.',
            'phone' => '101010',
            'address' => 'AV. TARIJA NRO. 225',
            'state' => 'ACTIVO'
        ]);

        // LOTE
        App\Batch::create([
            'product_id' => '1',
            'user_id' => '1',
            'provider_id' => '1',
            'line_id' => '38',
            'storage_id' => '38',
            'industry_id' => '11',
            'payment_status_id' => '5',
            'payment_type_id' => '8',
            'code' => '707466',
            'sanitary_registration' => 'RH25/89',
            'initial_stock' => '50',
            'stock' => '50',
            'batch_price' => '2500.00',
            'wholesaler_price' => '35.50',
            'entry_date' => '2019-08-07',
            'expiration_date' => '2019-12-07',
            'state' => 'ACTIVO'
        ]);
        // LOTE
        App\Batch::create([
            'product_id' => '2',
            'user_id' => '1',
            'provider_id' => '1',
            'line_id' => '38',
            'storage_id' => '38',
            'industry_id' => '11',
            'payment_status_id' => '5',
            'payment_type_id' => '8',
            'code' => '707466',
            'sanitary_registration' => 'RH25/89',
            'initial_stock' => '200',
            'stock' => '150',
            'batch_price' => '6000.00',
            'wholesaler_price' => '36.30',
            'entry_date' => '2019-08-07',
            'expiration_date' => '2019-12-07',
            'state' => 'ACTIVO'
        ]);
    }
}
