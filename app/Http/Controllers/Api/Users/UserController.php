<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\PersonalAccessToken;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    //
    public function GenToken(Request $request){
        
        if(!$request->filled('email')){
            return  response()->json( ['message' => 'Usuario o contraseña incorrecta'] , 400 );   
        }

        if(!$request->filled('password')){
            return  response()->json( ['message' => 'Usuario o contraseña incorrecta'] , 400 );   
        }

        $user = User::where('email', $request->input('email'))->first();
        
        //$decrypt = Crypt::decryptString($user->password);    
        $decryptedData = Crypt::decrypt($user->password);        
     
        if($request->input('password') != $decryptedData){
            return  response()->json( ['message' => 'Usuario o contraseña incorrecta'] , 400 );   
        }
        $token = Uuid::uuid4();
        $token = $token->toString();

        $token_data = new PersonalAccessToken();
        $token_data->email = $user->email;
        $token_data->token = $token;
        $token_data->save();

        $setSession = ['name' => $user->name, 'email'=>$user->email, 'token' => $token, 'role' => $user->role_id, 'role_name'=>$user->userRol[0]->name ]; 

        return  response()->json( ['resp' => $setSession ] , 200 );   

    }

    public function Read(Request $request, $id){
        $user = User::find($id);
        return  response()->json( ['data' => $user ] , 200 );   
    }


    public function SaveAvatar(Request $request, $id){
        $base64Data = $request->input('img_profile');
        $posicionComa = strpos($base64Data, ',');
        $base_64Imagen = substr($base64Data, $posicionComa +1);
        $decodeImage = base64_decode($base_64Imagen);
        $path_public = 'profile_'.$id.'/avatar';

        $folderPath = public_path($path_public);
        if(!file_exists(($folderPath))){
            mkdir($folderPath, 0755, true);
        }

        $imag_name = 'avatar.webp';
        $absoluteUrl = $path_public.'/'.$imag_name;
        $file_path = $folderPath.'/'.$imag_name;
        file_put_contents($file_path, $decodeImage);

        return response()->json(['message' => 'Imagen guardada', 'path_file', $absoluteUrl], 200);
    }

    public function List(Request $request){
        $users = User::all();

        $res_user = [];
        foreach($users as $user){
            $row = [];
            $row['id'] = $user->id;
            $row['fullname'] = $user->full_name;
            $row['email'] = $user->email;
            $row['created_at'] = $user->created_at;
            $row['role_id'] = $user->role_id;
            $row['role_name'] = (isset($user->userRol[0])) ? $user->userRol[0]->name: '';        

            $res_user[] = $row;
        }

        return response()->json(['resp' => $res_user], 200);
    }

    public function Add(Request $request){        

        //$password = Crypt::encryptString($request->input('password'));
        $password = Crypt::encrypt($request->input('password'));

        if(!$request->filled('name')){
            return  response()->json( ['message' => 'El nombre del usuario es requerido'] , 400 );   
        }

        try {
            $user = new User();        
            $user->name =               $request->input('name');    
            $user->email =              $request->input('email'); 
            $user->lastname =           $request->input('lastname');    
            $user->second_lastname =    $request->input('second_lastname');    
            $user->role_id =            $request->input('role_id');    
            $user->password =           $password;    
            $user->save();


            return  response()->json( ['message' => 'Usuario creado correctamente' ] , 200 );
        } catch (\Throwable $th) {
            //throw $th;

            return  response()->json( ['message' => 'Ocurrió un error', 'error' => $th ] , 400 );
        }
        
    }
}
