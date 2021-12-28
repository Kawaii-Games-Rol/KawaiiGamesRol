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
    public function Resuelta(Solicitud $solicitud)
    {
        $solicitud = solicitud::all();
        $usuarios = User::simplePaginate(5);


return view('Resuelta.index')->with('solicitudes',$solicitud)->with('usuarios',$usuarios);

    }

    public function Detalles2(String $id,String $alumno_id){

        $getUser = User::where('id', $id)->firstOrFail()->getSolicitudId($alumno_id)->first();
        return view('Detalles.index')->with('solicitud',$getUser);

    }
    public function AceptarSolicitud(String $id, String $alumno_id){

        $array = [1,2,3,4,5,6];

        $user = User::where('id','=', $id)->first();
        $user->solicitudes()->wherePivot('id', $alumno_id)->updateExistingPivot($array, [
            'estado' => 1

        ]);
        $user->save();
        Mail::to($user->email)->send(new EnvioCorreo($user,$alumno_id));
        return redirect('/GestionSolicitud');
    }

    public function AceptarOSolicitud(String $id, String $alumno_id){

        $array = [1,2,3,4,5,6];

        $user = User::where('id','=', $id)->first();
        $user->solicitudes()->wherePivot('id', $alumno_id)->updateExistingPivot($array, [
            'estado' => 2

        ]);
        $user->save();
        Mail::to($user->email)->send(new EnvioCorreo($user,$alumno_id));
        return redirect('/GestionSolicitud');
    }
    public function RechazarSolicitud(String $id, String $alumno_id){

        $array = [1,2,3,4,5,6];

        $user = User::where('id','=', $id)->first();
        $user->solicitudes()->wherePivot('id', $alumno_id)->updateExistingPivot($array, [
            'estado' => 3

        ]);
        $user->save();
        Mail::to($user->email)->send(new EnvioCorreo($user,$alumno_id));
        return redirect('/GestionSolicitud');
    }

    
    public function DatosSolicitud (String $id, String $alumno_id){

        $getUser = User::where('id', $id)->firstOrFail()->getSolicitudId($alumno_id)->first();

        $user = User::where('id',$id)->first();

        return view('Detalles.index')->with('solicitud',$getUser)->with('user',$user);
    }

    public function DatosSolicitud2 (String $id, String $alumno_id){

        $getUser = User::where('id', $id)->firstOrFail()->getSolicitudId($alumno_id)->first();

        $user = User::where('id',$id)->first();

        return view('Detalles2.index')->with('solicitud',$getUser)->with('user',$user);
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

    public function update(Request $request,Solicitud $solicitud)
    {
        $jefeCarrera = Auth::user()->carrera_id;
        $user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesActivas')->get();
        //dd($request->estado);
        //dd($request->observacionSolicitud);

        foreach ($user as $usuario){
            foreach ($usuario->solicitudesActivas as $solicitud){
                if ($solicitud->getOriginal()['pivot_id'] == $request->id_solicitud) {
                    $solicitud->pivot->estado = $request->resolverSolicitud;
                    $solicitud->pivot->save();
                    $observacion = $request->observacionSolicitud;

                    if ($request->estado ==1){
                        Mail::to($usuario->email)->send(new ResolucionSolicitudMail ($observacion,$solicitud));
                    }
                    else if ($request->estado ==2){
                        Mail::to($usuario->email)->send(new ResolucionSolicitudMail ($observacion,$solicitud));
                    }
                    else{
                        Mail::to($usuario->email)->send(new ResolucionSolicitudMail ($observacion,$solicitud));
                    }
                }
            }
        }
    }
}