<?php

namespace App\Imports;

use Throwable;
use App\Models\User;
use App\Rules\ValidarRut;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Freshwork\ChileanBundle\Facades\Rut;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;



class UsuarioImport implements ToModel,WithHeadingRow,SkipsOnError
{


    public function model(array $row)
    {
        return new User([
            'id_carrera'=>$row['id_carrera'],
            'rut'=>$row['rut'],
            'name'=>$row['name'],
            'email'=>$row['email'],
            'status'=>'1',
            'rol'=>'Alumno',
            'password' => Hash::make(Rut::parse($row['rut'])->number()),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required:users,email | unique:users,email',
            'rut' => 'required',
            'id_carrera'=>'required',
            'rol'=>'Alumno',
        ];
    }


    public function onError(Throwable $error)
    {

    }
}
