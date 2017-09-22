<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Membership;
use Mail;
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
                    if ($diasFaltantes >5) {
                        $usuario = \App\User::find($membresia->user->id);
                        
                        $title = "Aviso de expiración de membresía ";
                        $content = 'Le informamos que su membresía '.$usuario->membership->tipo." está pronta a expirar<br>Le recordamos que debe renovar nuestros servicios <br>Un saludo, UnitedCompany.";
                        Mail::send('email.expiration', ['title' => $title, 'content' => $content], function ($message)
                        {
                
                            $message->from('hola@unitedcompanyweb.com', 'United Company');
                            $message->subject('Aviso de expiración de membresía - United Company');
                            $message->to('randygil@webcoding.cl');
                
                        });
                        
                
                        return response()->json(['message' => 'Request completed']); 

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
