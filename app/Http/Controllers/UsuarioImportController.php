<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UsuarioImportController extends Controller
{
    public function index()
    {
        $auxErrores = [];
        $auxAdd = [];
        return view('usuario.import')->with('errores', $auxErrores)->with('nuevos', $auxAdd);
    }

    public function carga(Request $request)
    {
        $auxHeader = false;
        $auxDatos = new Request();
        $auxErrores = [];
        $auxAdd = [];
        $request->validate([
            "adjunto" => 'mimes:xlsx|required'
        ]);
        $doc = IOFactory::load($request->adjunto);
        $hoja1 = $doc->getSheet(0);

        if ($hoja1->getCell('A1')->getValue() == null|| $hoja1->getCell('B1')->getValue() == null|| $hoja1->getCell('C1')->getValue() == null|| $hoja1->getCell('D1')->getValue() == null){
            return redirect('carga-masiva')->with('nuevos',$auxAdd)->with('eliminados',$auxErrores)->with('error', 'Error: El archivo excel se encuentra vacío');
        }


        /* $auxErrores->errors = ["errorRut" => "linea 2" ];
        $auxErrores->errors['prueba'] = "nada"; */

        if (is_numeric($hoja1->getCell('A1')->getValue())) {
            $auxHeader = false;
        } else {
            $auxHeader = true;
        }

        if ($auxHeader) {
            foreach ($hoja1->getRowIterator(2, null) as $key => $fila) {
                foreach ($fila->getCellIterator() as $key => $celda) {
                    switch ($celda->getColumn()) {
                        case 'A':
                            $auxDatos->request->add(["carrera" => $celda->getValue()]);
                            break;
                        case 'B':
                            $auxDatos->request->add(["rut" => $celda->getValue()]);
                            break;
                        case 'C':
                            $auxDatos->request->add(["nombre" => $celda->getValue()]);
                            break;
                        case 'D':
                            $auxDatos->request->add(["email" => $celda->getValue()]);
                            break;

                        default:
                            # code...
                            break;
                    }
                }

                $validator = Validator::make($auxDatos->request->all(), [
                    "carrera" => "exists:carreras,codigo",
                    "rut" => 'unique:users,rut|required',
                    "name" => 'unique:users,nombre',
                    'email' => 'unique:users,email'
                ]);
                $auxErrores[$auxDatos->request->get('nombre')] = $validator->getMessageBag()->getMessages();
                if (!$validator->fails()) {
                    $carrera = Carrera::where('codigo', $auxDatos->request->all()["carrera"])->first();
                    //crear pass
                    $defaultpass= substr($auxDatos->request->all()["rut"],0,6);
                    $newUser = User::create([
                        'name' => $auxDatos->request->all()["nombre"],
                        'email' => $auxDatos->request->all()["email"],
                        'password' => Hash::make($defaultpass),
                        'rut' => $auxDatos->request->all()["rut"],
                        'rol' => "Alumno",
                        'status' => 1,
                        'carrera_id' => $carrera->id,
                    ]);
                    $auxAdd["fila".$fila->getRowIndex()] = $newUser;
                }
            }
        } else {
            foreach ($hoja1->getRowIterator(2, null) as $key => $fila) {
                foreach ($fila->getCellIterator() as $key => $celda) {
                    switch ($celda->getColumn()) {
                        case 'A':
                            $auxDatos->request->add(["carrera" => $celda->getValue()]);
                            break;
                        case 'B':
                            $auxDatos->request->add(["rut" => $celda->getValue()]);
                            break;
                        case 'C':
                            $auxDatos->request->add(["nombre" => $celda->getValue()]);
                            break;
                        case 'D':
                            $auxDatos->request->add(["email" => $celda->getValue()]);
                            break;

                        default:
                            # code...
                            break;
                    }
                }
                $validator = Validator::make($auxDatos->request->all(), [
                    "carrera" => "exists:carreras,codigo",
                    "rut" => 'unique:users,rut|required',
                    "name" => 'unique:users,nombre',
                    'email' => 'unique:users,email'
                ]);

                $auxErrores["fila" . $fila->getRowIndex()] = $validator->getMessageBag()->getMessages();
                if (!$validator->fails()) {
                    $carrera = Carrera::where('codigo', $auxDatos->request->all()["carrera"])->first();
                    $newUser = User::create([
                        'name' => $auxDatos->request->all()["nombre"],
                        'email' => $auxDatos->request->all()["email"],
                        'password' => Hash::make(123456),
                        'rut' => $auxDatos->request->all()["rut"],
                        'rol' => "Alumno",
                        'status' => 1,
                        'carrera_id' => $carrera->id,
                    ]);
                    $auxAdd["fila".$fila->getRowIndex()] = $newUser;
                }
            }
        }

        return view('usuario.import')->with('errores', $auxErrores)->with('nuevos', $auxAdd);
    }
}
