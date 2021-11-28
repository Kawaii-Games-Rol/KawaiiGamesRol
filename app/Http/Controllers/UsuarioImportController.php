<?php

namespace App\Http\Controllers;

use App\Imports\UsuarioImport;
use Illuminate\Http\Request;

class UsuarioImportController extends Controller
{
    public function show()
    {
        return view('usuario.import');
    }

    public function store(Request $request)
    {
        $file = $request->file('file')->store('import');

        $import = new UsuarioImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }


        return back()->withStatus('Import in queue, we will send notification after import finished.');
    }
}
