<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnularSolicitudController extends Controller
{
    public function AnularSolicitud(Request $request){
        $id_user = Auth::user()->id;
        $array = [1,2,3,4,6];
        $user = User::where('id','=',$id_user)->first();

        $user->solicitudes()->wherePivot('id', $request->id)->updateExistingPivot($array, [
            'estado' => 4
        ]);
        $user->save();
        return redirect('/solicitud');

    }
}
