<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(CatalogTypesTableSeeder::class);
         $this->call(CataloguesTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(LinesTableSeeder::class);
         $this->call(TestTableSeeder::class);
         $this->call(ClientsTableSeeder::class);
         
         
    }
}
