<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;

class FiltarSolicitudesController extends Controller
{

    public function devolverSolicitud(Request $request){//devolver la solicitud segun el numero de solicitud

        $findSolicitud = Solicitud::where('nrc', $request->nrc)->first();

        if (isset($findSolicitud)) {
            return redirect(route('mostrarSolicitud',['id' => $findSolicitud->id]));

        }else {
            return redirect('filtrarSolicitud')->with('error', 'El número de solicitud ingresado no existe.');
        }
    }

    public function devolverSolicitudTipo(Request $request){ //devolver la solicitud segun el tipo de solicitud

        $findSolicitud = Solicitud::where('tipo', $request->tipo)->first();

        if (isset($findSolicitud)) {
            return redirect(route('mostrarSolicitud',['id' => $findSolicitud->id]));

        }else {
            return redirect('filtrarSolicitud')->with('error', 'No existen solicitudes registradas.');
        }
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



}
