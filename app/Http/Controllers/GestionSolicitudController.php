<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GestionSolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudesAlumno = Auth::user()->solicitudes;
        return view('solicitud.index')->with('solicitudes', $solicitudesAlumno);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('solicitud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request->tipo) {
            case '1':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','required'],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
                    'detalle' => ['required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'NRC' => $request->nrc,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle
                ]);
                return redirect('/solicitud');
                break;
            case '2':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','required'],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
                    'detalle' => ['required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'NRC' => $request->nrc,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle
                ]);
                return redirect('/solicitud');
                break;
            case '3':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','required'],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
                    'detalle' => ['required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'NRC' => $request->nrc,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle
                ]);
                return redirect('/solicitud');
                break;
            case '4':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','required'],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
                    'detalle' => ['required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'NRC' => $request->nrc,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle
                ]);
                return redirect('/solicitud');
                break;
            case '5':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','required'],
                    'calificacion_aprob'=>$request->calificacion,
                    'cant_ayudantias' => $request->cantidad,
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'calificacion_aprob'=>$request->calificacion,
                    'nombre_asignatura' => $request->nombre,
                    'cant_ayudantias' => $request->cantidad,
                    'detalles' => $request->detalle,
                ]);
                return redirect('/solicitud');
                break;


            case '6':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','required'],
                    'nombre' => ['required'],
                    'detalle' => ['required'],
                    'facilidad' => ['required'],
                    'profesor' => ['required'],
                    'adjunto.*' => ['mimes:pdf','required'],
                ]);

                $findUser = User::find($request->user);

                $aux = 0;

                foreach ($request->adjunto as $file) {

                    $name = $aux.time().'-'.$findUser->name.'.pdf';
                    $file->move(public_path('\storage\docs'), $name);
                    $datos[] = $name;
                    $aux++;
                }

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle,
                    'tipo_facilidad' => $request->facilidad,
                    'nombre_profesor' => $request->profesor,
                    'archivos' => json_encode($datos),
                ]);
                return redirect('/solicitud');
                break;

            default:

                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $solicitud)
    {
        $solicitud = solicitud::all();
        $usuarios = User::simplePaginate(5);
       
        return view('GestionSolicitud.index')->with('solicitudes',$solicitud)->with('usuarios',$usuarios);
    }  
    
   
    public function Detalles(String $id){
      
        
        $user = User::where('id', $id)->with('carrera')->where('solicitudes')->first();
        
        return view('Detalles.index')->with('user',$user);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(String  $id)
    {
        $getUser =  Auth::user()->solicitudes;
        foreach($getUser as $key => $solicitud){
            if($solicitud->getOriginal()["pivot_id"] == $id ){

                return view('solicitud.edit')->with('solicitud',$solicitud);
            }

        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }
}
