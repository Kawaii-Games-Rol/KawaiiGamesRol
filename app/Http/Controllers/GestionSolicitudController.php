<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GestionSolicitudController extends Controller
{
    public function show(Solicitud $solicitud)
    {
        $solicitud = solicitud::all();
        $usuarios = User::simplePaginate(5);
       
        return view('GestionSolicitud.index')->with('solicitudes',$solicitud)->with('usuarios',$usuarios);
    }  
    
   
    public function Detalles2(String $id,String $alumno_id){
      
        $getUser = User::where('id', $id)->firstOrFail()->getSolicitudId($alumno_id)->first();
        return view('Detalles.index')->with('solicitud',$getUser);
    }

    public function update(Request $request)
    {
      
        $findUser = User::where('rut', $request->rut)->first();
        if (isset($findUser)) {
            if ($findUser->rol == "Alumno") {
                return redirect(route('postDetalles',['id' => $findUser->id]));
            }else {
                return redirect('buscarEstudiante')->with('error', 'Error.');
            }
        }else {
            return redirect('buscarEstudiante')->with('error', 'Error.');
        }
    }

    public function DatosSolicitud (String $id, String $alumno_id){

        $getUser = User::where('id', $id)->firstOrFail()->getSolicitudId($alumno_id)->first();
        $user = User::where('id',$id)->first();
        return view('Detalles.index')->with('solicitud',$getUser)->with('user',$user);
    }



    public function edit(String  $id)
    {
        $getUser =  Auth::user()->solicitudes;
        foreach($getUser as $key => $solicitud){
            if($solicitud->getOriginal()["pivot_id"] == $id ){

                return view('solicitud.edit')->with('solicitud',$solicitud);
            }

        }


    }

}
