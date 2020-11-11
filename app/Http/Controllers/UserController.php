<?php

namespace App\Http\Controllers;

use App\Aspiration;
use App\Mahasiswa;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Index($user)
    {
        if ($user != session(0)->id_mahasiswa){
            $aspirasi_mhs = Aspiration::getAspirasiByUser(session(0)->id_mahasiswa);
            $mhs = Mahasiswa::find(session(0)->id_mahasiswa);
            return view('users.profile',['aspirasi_mhs'=>$aspirasi_mhs, 'mhs' => $mhs]);
        }else{
            $aspirasi_mhs = Aspiration::getAspirasiByUser($user);
            $mhs = Mahasiswa::find($user);
            return view('users.profile',['aspirasi_mhs'=>$aspirasi_mhs, 'mhs' => $mhs]);
        }
    }
}
