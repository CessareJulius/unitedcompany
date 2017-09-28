<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Membership;
use Illuminate\Support\Facades\Mail;
use App\Mail\MembresiaExpirada;
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
                    
                    $usuario = \App\User::find($membresia->user->id);
                        
                    $diasFaltantes = \Carbon\Carbon::parse($membresia->expiration)->diff(\Carbon\Carbon::now())->days;
                    if($diasFaltantes<=2 && $membresia->notifiable==1) {
                        Mail::to($usuario)->send(new MembresiaExpirada($membresia->membership->tipo,url('cliente/membership/renovation'),'Membresía expirada',2));
                        $membresia->notifiable = 2;
                        $membresia->status = 'Expirado';
                        $membresia->update();
                    }

                    if ($diasFaltantes <5)  {
                       if ($membresia->notifiable==0 || !$membresia->notifiable)  {
                        Mail::to($usuario)->send(new MembresiaExpirada($membresia->membership->tipo,url('cliente/membership/renovation'),'Aviso de expiración de membresía',1));
                        $membresia->notifiable = 1;

                        $membresia->update();
                        }

                    }
                


                }


            })->everyMinute();
        
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
