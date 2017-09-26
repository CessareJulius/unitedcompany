<?php

use Illuminate\Database\Seeder;
use App\Memberships;
class MembershipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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



    }
}
