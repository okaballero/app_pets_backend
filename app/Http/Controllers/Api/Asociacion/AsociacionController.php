<?php

namespace App\Http\Controllers\Api\Asociacion;

use App\Http\Controllers\Controller;
use App\Models\Asociaciones;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class AsociacionController extends Controller
{
    //
    public function Register(Request $request){
        //return response()->json(['data' => $request->all() ], 200);
        $validator = Validator::make($request->all(),[
            'name' => ['required', function($attribute, $value, $fail) use ($request ) {
                $asociation = Asociaciones::where('name' , $request->input('name'))->first();
                if($asociation){
                    $fail('Esta asociacion ya fue registrada');
                }
            }],
            'address' => ['required'],

        ] );

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors() ], 422);
        }
        //return  response()->json( ['message' => 'Va a crear una asociaciónn'] , 200 );   

        $asociation = new Asociaciones();
        $asociation->logo               = '';
        $asociation->name               = $request->input('name');
        $asociation->address            = $request->input('address');
        $asociation->phone              = $request->input('phone');
        $asociation->email              = $request->input('email');
        $asociation->lat                = $request->input('lat');
        $asociation->lng                = $request->input('lng');
        $asociation->description        = $request->input('description');
        $asociation->contact_name       = $request->input('contact_name');
        $asociation->contact_last_name  = $request->input('contact_last_name');
        $asociation->contact_phone      = $request->input('contact_phone');
        $asociation->contact_email      = $request->input('contact_email');
        $asociation->save();

        $tmp_password = Str::random(8);
        $password = Crypt::encrypt($tmp_password);

        try {
            $user = new User();        
            $user->name =               $request->input('contact_name');    
            $user->email =              $request->input('contact_email'); 
            $user->lastname =           $request->input('contact_last_name');    
            $user->second_lastname =    '';    
            $user->role_id =            2;    
            $user->password =           $password;    
            $user->asociation_id =      $asociation->id;    
            $user->save();

            $params = ['name' => $user->name, 
                        'content' => 'Registrado'];
            $this->SendRegisterMail($params, 'mails.register', 'Registro exitoso' );

            return  response()->json( ['message' => 'Usuario creado correctamente', 'password_tmp' =>$tmp_password  ] , 200 );
        } catch (\Throwable $th) {
            //throw $th;

            return  response()->json( ['message' => 'Ocurrió un error', 'error' => $th ] , 400 );
        }
    }

    public function SendRegisterMail($params, $template, $subject ){
        
        Mail::to('empireweb.mx+demo@gmail.com')->send( new SendMail($params, $template, $subject) );

        return response()->json(['message'=> 'Correo eviado correctamente']);
    }
}
