<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;

class FiltarSolicitudesController extends Controller
{

    public function devolverSolicitud(Request $request){//devolver la solicitud segun el numero de solicitud
       
 
    
        $solicitud = solicitud::all();
        $usuarios = User::simplePaginate(5);
        
        return view('filtrarNumero.index')->with('solicitudes',$solicitud)->with('usuarios',$usuarios)->with('numero',$request->numero);

    }
    public function devolverSolicitudTipo(Request $request){ //devolver la solicitud segun el tipo de solicitud

        dd($request);
        $solicitud2 = solicitud::all();
        $usuarios = User::simplePaginate(5);
        
        return view('filtrarTipo.index')->with('solicitudes',$solicitud2)->with('usuarios',$usuarios)->with('numero',$request->$solicitud);

    }
    public function mostrarSolicitud(String $id){

        $solicitud = Solicitud::where('id', $id)->first();

        return view('filtrarNumero.index')->with('user',$solicitud);
    }

    public function DatosNumero (String $id, String $alumno_id){ //detalle de la solicitud segun numero de solicitud

        $getUser = User::where('id', $id)->firstOrFail()->getSolicitudId($alumno_id)->first();
        return view('datosSolicitud.index')->with('solicitud',$getUser);
    }

    public function DatosTipo (String $id, String $alumno_id){  //detalle de la solicitud segun tipo de solicitud

        $getUser = User::where('id', $id)->firstOrFail()->getSolicitudId($alumno_id)->first();
        return view('datosSolicitud.index')->with('solicitud',$getUser);
    }
    public function NumeroBuscar(Solicitud $solicitud)
    {
        $solicitud = solicitud::all();
        $usuarios = User::simplePaginate(5);
        
return view('filtrarNumero.index')->with('solicitudes',$solicitud)->with('usuarios',$usuarios);
     
    }  


}
