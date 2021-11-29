<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Imports\UsuarioImport;
use Maatwebsite\Excel\Facades\Excel;


class UsuarioImportController extends Controller
{
    public function show()
    {
        return view('usuario.import');
    }

    public function store(Request $request)
    {

        $file = $request->file('file')->store('import');

        Excel::import(new UsuarioImport, $file);



        return back()->withStatus('¡Los datos han sido cargados exitosamente!');
    }


}

