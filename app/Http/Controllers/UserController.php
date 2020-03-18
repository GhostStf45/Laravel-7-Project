<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\User;

class UserController extends Controller
{
    //Middleware
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Pagina de usuarios
    public function index($search = null){
        if(!empty($search)){
            //buscar usuarios en todos sus apartados
            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                    ->orWhere('name', 'LIKE', '%'.$search.'%')
                     ->orWhere('surname', 'LIKE', '%'.$search.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(5);
        }else{
            $users  = User::orderBy('id', 'desc')->paginate(5);
        }
        return view ('user.index', [
            'users' => $users
        ]);
    }
    
    public function config(){
        return view('user.config');
    }
    //Actualizar usuario
    public function update(Request $request){
        
       
        
        
        //Conseguir usuario identificado 
        $user = \Auth::user();
        $id = $user->id;
        //Validacion del formulario
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|max:255|unique:users,email,'.$id
            
        ]);
        //Recoger datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');
        
        //Asignar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;
        
         //Subir la imagen
        
        $image_path= $request->file('image');
        if($image_path){
            //Poner nombre unico
            $image_path_name = time().$image_path->getClientOriginalName();
            //Guardar en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            //Seteo el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }
        
        //ejecutar consulta y cambios en la bd
        
        $user->update();
        
        
        return redirect()->route('config')
                ->with(['message'=>'Usuario actualizado correctamente']); 
    }
    //conseguir imagen
    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
    
    public function profile ($id){
        $user = User::find($id);
        
        return view('user.profile', [
           'user' => $user 
        ]);
    }
    
}
