<?php
use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        


    }
}
