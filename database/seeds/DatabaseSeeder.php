<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Memberships;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
             //Insert Roles:

        $rroot = Role::create([
            'id'=>3,
            'name'=>'root',
            'display_name'=>'Root',
            'description'=>'Dueño del sistema'
        ]);

        $radmin = Role::create([
            'id'=>2,
            'name'=>'admin',
            'display_name'=>'Administrador',
            'description'=>'Administrador del sistema'
        ]);

        

        $rcliente = Role::create([
            'id'=>1,
            'name'=>'cliente',
            'display_name'=>'Cliente',
            'description'=>'Cliente del sistema'
        ]);

       $admin = User::create([
            'user' => 'admin',
            'name' => 'admin',
            'email' => 'admin@unitedcompany.com',
            'password' => bcrypt('admin'),
        ]);
        $admin->attachRole($rroot);
        


        $gold = Memberships::create([
            'id'=>1,
            'tipo'=>'GOLD',
            'precio'=>100
            
        ]);
        $silver = Memberships::create([
            'id'=>2,
            'tipo'=>'SILVER',
            'precio'=>70
        ]);
        $bronce = Memberships::create([
            'id'=>3,
            'tipo'=>'BRONCE',
            'precio'=>50
        ]);

        //$this->call(MembershipTableSeeder::class);
    }
}
