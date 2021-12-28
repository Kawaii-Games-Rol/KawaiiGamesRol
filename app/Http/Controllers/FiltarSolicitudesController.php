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
        
        return view('filtrarNumero.index')->with('solicitudes',$solicitud)->with('usuarios',$usuarios)->with('numero',$request->numero)->with('tipo',$request->solicitud);

    }
  
    public function mostrarSolicitud(String $id){

        $solicitud = Solicitud::where('id', $id)->first();

        return view('filtrarNumero.index')->with('user',$solicitud);
    }

 

   
    public function NumeroBuscar(Solicitud $solicitud)
    {
        $solicitud = solicitud::all();
        $usuarios = User::simplePaginate(5);
        
return view('filtrarNumero.index')->with('solicitudes',$solicitud)->with('usuarios',$usuarios);
     
    }  


}
