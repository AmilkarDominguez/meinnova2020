<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    //PERMISOS DE CATALOGOS    
        Permission::create([
            'name'        => 'Visualizar Industria',
            'slug'        => 'industry',
            'description' => 'Puede navegar en la vista de Industria de Productos',
        ]);
        Permission::create([
            'name'        => 'Visualizar Linea',
            'slug'        => 'line',
            'description' => 'Puede navegar en la vista de Lineas de Productos',
        ]);
        Permission::create([
            'name'        => 'Visualizar Depositos',
            'slug'        => 'deposit',
            'description' => 'Puede navegar en la vista de Depositos de Productos',
        ]);
        Permission::create([
            'name'        => 'Visualizar Zonas',
            'slug'        => 'zone',
            'description' => 'Puede navegar en la vista de Zonas',
        ]);
        

        Permission::create([
            'name'        => 'Crear registros en catalogos',
            'slug'        => 'catalogs.store',
            'description' => 'Puede crear registros',
        ]);

        Permission::create([
            'name'        => 'Editar registro de catalogos',
            'slug'        => 'catalogs.edit',
            'description' => 'Puede editar registros',
        ]);

        /*Permission::create([
            'name'        => 'Actualizar registros de catalogos',
            'slug'        => 'catalogs.update',
            'description' => 'Puede actualizar registros',
        ]);*/

        Permission::create([
            'name'        => 'Eliminar Industrias',
            'slug'        => 'catalogs.destroy',
            'description' => 'Puede eliminar registro',
        ]);

        ///PERMISOS DE PRODUCTOS
        
        Permission::create([
            'name'        => 'Visualizar Productos',
            'slug'        => 'product',
            'description' => 'Puede navegar en la vista de productos',
        ]);

        Permission::create([
            'name'        => 'Crear registros en Productos',
            'slug'        => 'product.store',
            'description' => 'Puede crear registros',
        ]);

        Permission::create([
            'name'        => 'Editar registro de Productos',
            'slug'        => 'product.edit',
            'description' => 'Puede editar registros',
        ]);

        /*Permission::create([
            'name'        => 'Actualizar registros de Productos',
            'slug'        => 'product.update',
            'description' => 'Puede actualizar registros',
        ]);*/

        Permission::create([
            'name'        => 'Eliminar registros de Productos',
            'slug'        => 'product.destroy',
            'description' => 'Puede eliminar registros',
        ]);


        ///PERMISOS DE LOTES
        
        Permission::create([
            'name'        => 'Visualizar Lotes',
            'slug'        => 'batch',
            'description' => 'Puede navegar en la vista de Lotes',
        ]);

        Permission::create([
            'name'        => 'Crear registros en Lotes',
            'slug'        => 'batch.store',
            'description' => 'Puede crear registros',
        ]);

        Permission::create([
            'name'        => 'Editar registro de Lotes',
            'slug'        => 'batch.edit',
            'description' => 'Puede editar registros',
        ]);

        /*Permission::create([
            'name'        => 'Actualizar registros de Lotes',
            'slug'        => 'batch.update',
            'description' => 'Puede actualizar registros',
        ]);*/

        Permission::create([
            'name'        => 'Eliminar registros de Lotes',
            'slug'        => 'batch.destroy',
            'description' => 'Puede eliminar registros',
        ]);


         ///PERMISOS DE PROVEEDORES
        
         Permission::create([
            'name'        => 'Visualizar Proveedores',
            'slug'        => 'provider',
            'description' => 'Puede navegar en la vista de Proveedores',
        ]);

        Permission::create([
            'name'        => 'Crear registros en Proveedores',
            'slug'        => 'provider.store',
            'description' => 'Puede crear registros',
        ]);

        Permission::create([
            'name'        => 'Editar registro de Proveedores',
            'slug'        => 'provider.edit',
            'description' => 'Puede editar registros',
        ]);

        /*Permission::create([
            'name'        => 'Actualizar registros de ProdProveedores',
            'slug'        => 'provider.update',
            'description' => 'Puede actualizar registros',
        ]);*/

        Permission::create([
            'name'        => 'Eliminar registros de Proveedores',
            'slug'        => 'provider.destroy',
            'description' => 'Puede eliminar registros',
        ]);


        ///PERMISOS DE VENDEDORES
        
        Permission::create([
            'name'        => 'Visualizar Vendedores',
            'slug'        => 'seller',
            'description' => 'Puede navegar en la vista de Vendedores',
        ]);

        Permission::create([
            'name'        => 'Crear registros en Vendedores',
            'slug'        => 'seller.store',
            'description' => 'Puede crear registros',
        ]);

        Permission::create([
            'name'        => 'Editar registro de Vendedores',
            'slug'        => 'seller.edit',
            'description' => 'Puede editar registros',
        ]);

        /*Permission::create([
            'name'        => 'Actualizar registros de ProdVendedores',
            'slug'        => 'seller.update',
            'description' => 'Puede actualizar registros',
        ]);*/

        Permission::create([
            'name'        => 'Eliminar registros de Vendedores',
            'slug'        => 'seller.destroy',
            'description' => 'Puede eliminar registros',
        ]);



        ///PERMISOS DE CLIENTES
        
        Permission::create([
            'name'        => 'Visualizar Clientes',
            'slug'        => 'client',
            'description' => 'Puede navegar en la vista de Clientes',
        ]);

        Permission::create([
            'name'        => 'Crear registros en Clientes',
            'slug'        => 'client.store',
            'description' => 'Puede crear registros',
        ]);

        Permission::create([
            'name'        => 'Editar registro de Clientes',
            'slug'        => 'client.edit',
            'description' => 'Puede editar registros',
        ]);

        /*Permission::create([
            'name'        => 'Actualizar registros de ProdClientes',
            'slug'        => 'client.update',
            'description' => 'Puede actualizar registros',
        ]);*/

        Permission::create([
            'name'        => 'Eliminar registros de Clientes',
            'slug'        => 'client.destroy',
            'description' => 'Puede eliminar registros',
        ]);

        ///PERMISOS DE COBRADORES
        
        Permission::create([
            'name'        => 'Visualizar Cobradores',
            'slug'        => 'collector',
            'description' => 'Puede navegar en la vista de Cobradores',
        ]);

        Permission::create([
            'name'        => 'Crear registros en Cobradores',
            'slug'        => 'collector.store',
            'description' => 'Puede crear registros',
        ]);

        Permission::create([
            'name'        => 'Editar registro de Cobradores',
            'slug'        => 'collector.edit',
            'description' => 'Puede editar registros',
        ]);

        /*Permission::create([
            'name'        => 'Actualizar registros de ProdCobradores',
            'slug'        => 'collector.update',
            'description' => 'Puede actualizar registros',
        ]);*/

        Permission::create([
            'name'        => 'Eliminar registros de Cobradores',
            'slug'        => 'collector.destroy',
            'description' => 'Puede eliminar registros',
        ]);


        ////PERMISOS DE USUARIOS

        Permission::create([
            'name'        => 'Visualizar Usuarios',
            'slug'        => 'user',
            'description' => 'Puede navegar en la vista de Usuarios',
        ]);

        Permission::create([
            'name'        => 'Crear registros en Usuarios',
            'slug'        => 'user.store',
            'description' => 'Puede crear registros',
        ]);

        /*Permission::create([
            'name'        => 'Editar registro de Usuarios',
            'slug'        => 'user.edit',
            'description' => 'Puede editar registros',
        ]);*/

        Permission::create([
            'name'        => 'Actualizar registros de ProdUsuarios',
            'slug'        => 'user.update',
            'description' => 'Puede actualizar registros',
        ]);

        Permission::create([
            'name'        => 'Eliminar registros de Usuarios',
            'slug'        => 'user.destroy',
            'description' => 'Puede eliminar registros',
        ]);



        ////PERMISOS DE PAGOS

        Permission::create([
            'name'        => 'Visualizar Pagos',
            'slug'        => 'payment',
            'description' => 'Puede navegar en la vista de Pagos',
        ]);

        Permission::create([
            'name'        => 'Crear registros en Pagos',
            'slug'        => 'payment.store',
            'description' => 'Puede crear registros',
        ]);

        Permission::create([
            'name'        => 'Editar registro de Pagos',
            'slug'        => 'payment.edit',
            'description' => 'Puede editar registros',
        ]);

        Permission::create([
            'name'        => 'Actualizar registros de Pagos',
            'slug'        => 'payment.update',
            'description' => 'Puede actualizar registros',
        ]);

        Permission::create([
            'name'        => 'Eliminar registros de Pagos',
            'slug'        => 'payment.destroy',
            'description' => 'Puede eliminar registros',
        ]);



        
        ////PERMISOS DE COBROS

        Permission::create([
            'name'        => 'Visualizar Cobros',
            'slug'        => 'charge',
            'description' => 'Puede navegar en la vista de Cobros',
        ]);

       /* Permission::create([
            'name'        => 'Crear registros en Cobros',
            'slug'        => 'charge.store',
            'description' => 'Puede crear registros',
        ]);*/

        Permission::create([
            'name'        => 'Editar registro de Cobros',
            'slug'        => 'charge.edit',
            'description' => 'Puede editar registros',
        ]);

        Permission::create([
            'name'        => 'Actualizar registros de Cobros',
            'slug'        => 'charge.update',
            'description' => 'Puede actualizar registros',
        ]);

        Permission::create([
            'name'        => 'Eliminar registros de Cobros',
            'slug'        => 'charge.destroy',
            'description' => 'Puede eliminar registros',
        ]);





        ////PERMISOS DE VENTA

        Permission::create([
            'name'        => 'Visualizar Venta',
            'slug'        => 'sale',
            'description' => 'Puede navegar en la vista de Venta',
        ]);

        Permission::create([
            'name'        => 'Crear registros en Venta',
            'slug'        => 'sale.store',
            'description' => 'Puede crear registros',
        ]);

        /*Permission::create([
            'name'        => 'Editar registro de Venta',
            'slug'        => 'sale.edit',
            'description' => 'Puede editar registros',
        ]);*/

        Permission::create([
            'name'        => 'Ver  registros de Venta e Imprimir',
            'slug'        => 'sale.show',
            'description' => 'Puede actualizar registros',
        ]);

        Permission::create([
            'name'        => 'Actualizar registros de Venta',
            'slug'        => 'sale.update',
            'description' => 'Puede actualizar registros',
        ]);

        Permission::create([
            'name'        => 'Eliminar registros de Venta',
            'slug'        => 'sale.destroy',
            'description' => 'Puede eliminar registros',
        ]);

          ////PERMISOS DE SHOP

          Permission::create([
            'name'        => 'Visualizar el formulario de la Venta',
            'slug'        => 'shop',
            'description' => 'Puede navegar en la vista de Venta',
        ]);

        Permission::create([
            'name'        => 'Crear registros en Venta',
            'slug'        => 'shop.store',
            'description' => 'Puede crear registros',
        ]);

        ////PERMISOS DE SALECOMPLETED

        Permission::create([
            'name'        => 'Visualizar las ventas concluidas',
            'slug'        => 'salecompleted',
            'description' => 'Puede navegar en la vista de ventas concluidas',
        ]);













        ///////////////////////////////////////
        ////////////////////////////////////////    

        // ROLES//
        $root = Role::create([
            'name'   => 'Administrador del Sitio',
            'slug'   => 'root',
            'description' =>'Todos los privilegios',
            'special'=> 'all-access'
        ]);
        $manager = Role::create([
            'name'   => 'Manager',
            'slug'   => 'manager',
            'description' =>'Administrador general menor'
        ]);
        $guest = Role::create([
            'name'   => 'Invitado',
            'slug'   => 'guest',
            'description' =>'Solo puede ver recursos, pero no participar'
        ]);
        $consultant = Role::create([
            'name'   => 'Consultor',
            'slug'   => 'consultant',
            'description' =>'Solo puede ver recursos, pero no participar'
        ]);
        $owner = Role::create([
            'name'   => 'Propietario',
            'slug'   => 'owner',
            'description' =>'Solo puede ver recursos, pero no participar'
        ]);

        

        //ASIGNAR PERMISOS A LOS ROLES
        $manager->givePermissionTo('industry','line','deposit','zone','catalogs.store','catalogs.edit', 'catalogs.destroy','catalogs.update',
        'product','product.store','product.edit','product.destroy',
        'batch','batch.store','batch.edit','batch.destroy',
        'provider','provider.store','provider.edit','provider.destroy',
        'seller','seller.store','seller.edit','seller.destroy',
        'client','client.store','client.edit','client.destroy',
        'collector','collector.store','collector.edit','collector.destroy',
        //'user','user.store','user.update','user.destroy',
        'payment','payment.store','payment.edit','payment.update','payment.destroy',
        'charge','charge.edit','charge.update','charge.destroy',
        'sale','sale.show','sale.update','sale.destroy',
        'shop','shop.store',
        'salecompleted'
        );

        $consultant->givePermissionTo('batch','product','sale');

        $owner->givePermissionTo('industry','line','deposit','zone',
        'product',
        'batch',
        'provider',
        'seller',
        'client',
        'collector',
        'charge',
        'sale','sale.show',
        'shop',
        'payment',
        'salecompleted'

        );
        $guest->givePermissionTo('industry','line','zone','deposit','product','batch','provider','seller','client','collector');


        

        //CREA EL USUARIOS
        $bytemo = App\User::create([
            'name' => 'bytemo',
            'email'=> 'bytemo@bytemo.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'password' => bcrypt('bytemo'),
            'remember_token' => str_random(10)            
        ]);

        $lucena = App\User::create([
            'name' => 'lucena',
            'email'=> 'lmiranda@miranda.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'password' => bcrypt('madison'),
            'remember_token' => str_random(10)            
        ]);

        $admin = App\User::create([
            'name' => 'administrador',
            'email'=> 'administrador@miranda.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'password' => bcrypt('administrador1'),
            'remember_token' => str_random(10)            
        ]);


        $miranda = App\User::create([
            'name' => 'administrador visualizador',
            'email'=> 'rmiranda@miranda.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'password' => bcrypt('angelica'),
            'remember_token' => str_random(10)            
        ]);
        ///vendedores y cobradores
        $seller = App\User::create([
            'name' => 'vendedor',
            'email'=> 'vendedores@miranda.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'password' => bcrypt('vendedoresmiranda'),
            'remember_token' => str_random(10)            
        ]);
        
        $collectors = App\User::create([
            'name' => 'cobradores',
            'email'=> 'cobradores@miranda.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'password' => bcrypt('mirandacobradores'),
            'remember_token' => str_random(10)            
        ]); 






        //ASIGNACION DE ROLES
        $bytemo->assignRoles('root');
        $lucena->assignRoles('manager');
        $admin->assignRoles('manager');

        $miranda->assignRoles('owner');

        $seller->assignRoles('consultant');
        $collectors->assignRoles('consultant');
        //$invited->assignRoles('guest');

    }
}
