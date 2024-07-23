<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class reminder_user extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reminder_user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para enviar invitación a un evento';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $users = User::all();
        $template   = 'mails.invitacion';
        $subject    = 'Invitacion a la adopción';
        foreach ($users as $user) {
            
            $params = [];
            $params['full_name'] = $user->full_name;
            $params['dia_evento'] = 'Domingo ';
            $params['location'] = 'Plaza Buenavista';

            try{
                Mail::to($user->email)->send( new SendMail($params, $template, $subject) );
                $this->info('Correo envia a ::'.$user->email);
            } catch (\Throwable $th) {
                //throw $th;
                $this->info('No se pudo enviar el coreo :::'.$user->email);
            }
            
        }
        
    }
}
