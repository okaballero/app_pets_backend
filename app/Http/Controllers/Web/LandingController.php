<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use App\Models\Asociaciones;
use Illuminate\Support\Facades\Mail;

class LandingController extends Controller
{
    //
    public function Index(){
        $config = [];
        $config['title']        = 'Bienvenido a recue pets desde controlador';
        return view('landing.home', $config);
    }

    public function Register(Request $request){
        $config = [];
        $config['correo'] = null;
        $config['description'] = null;

        $config['Lista_asociaciones'] =  Asociaciones::all();

        if($request->isMethod('post')){
            $request->validate([
                'email' => ['required','email'],
                'description' => ['required'],
                'subject' => ['required']
            ]);
            
            $config['correo'] = $request->input('email');
            $config['description'] = $request->input('description');

            $params     = [ 'body_mail' => $request->input('description')];
            $template   = 'mails.predeterminado';
            $subject    = $request->input('subject');
            $correo     = $request->input('email');

            // try {
                $this->SendRegisterMail($params, $template, $subject, $correo);
                //return redirect()->back()->with('success', 'Correo enviado correctamente');
            // } catch (\Throwable $th) {
            //     print_r('No se pudo enviar el correo');
            //     print_r($th);exit;
            // }
        }

        return view('landing.registro', $config);
    }

    public function SendRegisterMail($params = Null, $template, $subject, $correo ){
        
        Mail::to($correo)->send( new SendMail($params, $template, $subject) );

        return response()->json(['message'=> 'Correo eviado correctamente']);
    }


    public function Invitacion(){
        $config = [];

        $config['full_name'] = 'Omar Caballero';
        $config['dia_evento'] = 'Domingo ';
        $config['location'] = 'Plaza Buenavista';
        return view('mails.invitacion', $config);
    }
}
