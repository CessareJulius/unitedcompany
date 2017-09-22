<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Membership;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        
            $schedule->call(function () {
                
                //DB::table('recent_users')->delete();
                $membresias = Membership::all();

                foreach($membresias as $membresia) {
                    
                    $diasFaltantes = \Carbon\Carbon::parse($membresia->expiration)->diff(\Carbon\Carbon::now())->days;
                    if ($diasFaltantes <5) {
                        
                        

                    }



                }


            })->daily();
        
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
