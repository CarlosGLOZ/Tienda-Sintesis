<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\EnviarCorreo;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Sign Up page
     */
    public function signup()
    {
        return view('auth.signup');
    }

    /**
     * Sign In page
     */
    public function signin()
    {
        return view('auth.signin');
    }

    /**
     * Register new user
     */
    public function register(Request $request)
    {
        // Validate user
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'confirmed'
        ]);

        // Store user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Sign user in
        auth()->attempt($request->only('email', 'password'));

        // Redirect
        return redirect()->route('home');
    }

    /**
     * Log existing user in
     */
    public function login(Request $request)
    {
        // Validate user
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        // Sign user in
        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Invalid user or password');
        }

        // Redirect
        return redirect()->route('home');
    }

    /**
     * Log user out
     */
    public function logout(Request $request)
    {
        // Sign user out
        auth()->logout();

        return redirect()->route('home');
    }

    // -----------------------------------------------------------

    public function enviarEmail(){
        return view('enviarEmail');
    }

    public function FuncionMail(Request $req){
        $co=$req->input('Destinatario');

        //CORREO PARA TODOS LOS USUARIOS
        if ($co=="Todos los usuarios") {
        $correos = User::select('email')->get();

        $sub=$req->input('Asunto');

        $msg=$req->input('Mensaje');



        $datos=array('msg'=>$msg);


        foreach ($correos as $correo) {
            $enviar= new EnviarCorreo($datos);
            $enviar->sub=$sub;
            Mail::to($correo)->send($enviar);
        }

        return redirect('/enviarEmail');
        
        } else {
            //CORREO PARA LOS USUARIOS ESCRITOS A MANO EN EL CAMPO DE DESTINATARIO
            $correos=explode(',', $co);   

            $sub=$req->input('Asunto');

            $msg=$req->input('Mensaje');



            $datos=array('msg'=>$msg);

        
            foreach ($correos as $correo) {
                $enviar= new EnviarCorreo($datos);
                $enviar->sub=$sub;
                Mail::to($correo)->send($enviar);
            }


            
                // $enviar= new EnviarCorreo($datos);
                // $enviar->sub=$sub;
                // Mail::to($co)->send($enviar);
            
        
            return redirect('/enviarEmail');
        }


    }



    public function listarCorreos(Request $req){

        $buscador=$req->except('_token');
        /* $buscador='Mc'; */
        /* echo $buscador; */
        /* echo $buscador['buscar']; */
        /* dd($request); */
        $consulta=User::where('email', 'like', '%'.$buscador['buscar'].'%')->get();
        /* $count = $consulta->count(); */
        return response()->json($consulta);



    }



}

