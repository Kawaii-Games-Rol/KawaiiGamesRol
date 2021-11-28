<?php

namespace App\Imports;

use Throwable;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
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

class UsersImport implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading,
    ShouldQueue,
    WithEvents
{
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;


    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(),[

            '*.name' => 'required',
            '*.email' => 'required:users,email | unique:users,email',
            '*.rut' => 'required',
            '*.id_carrera'=>'required',

        ])->validate();


        foreach ($rows as $row) {
            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'rut' => $row['required'],
                'id_carrera'=>$row['required'],
                'status'=>1,
                'password'=>Hash::make('password')
            ]);


        }
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required:users,email | unique:users,email',
            'rut' => 'required',
            'id_carrera'=>'required',
        ];
    }


    public function onError(Throwable $error)
    {

    }

    public function rules(): array
    {
        return[

        ]



    }
