<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
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
      'name' => 'CABLE DE RED CAT. 5',
      'catalog_product_id' => 1,
      'description' => '',
      'state' => 'ACTIVO',
    ]);
    App\Product::create([
      'name' => 'CABLE DE RED CAT. 6',
      'catalog_product_id' => 1,
      'description' => '',
      'state' => 'ACTIVO',
    ]);
    App\Product::create([
      'name' => 'CONECTOR RJ45',
      'catalog_product_id' => 1,
      'description' => '',
      'state' => 'ACTIVO',
    ]);
    App\Product::create([
      'name' => 'TECLADO M485',
      'catalog_product_id' => 1,
      'description' => '',
      'state' => 'ACTIVO',
    ]);
    App\Product::create([
      'name' => 'TECLADO KP225',
      'catalog_product_id' => 1,
      'description' => '',
      'state' => 'ACTIVO',
    ]);
    App\Product::create([
      'name' => 'CRIMPADORA',
      'catalog_product_id' => 1,
      'description' => '',
      'state' => 'ACTIVO',
    ]);
  }
}
