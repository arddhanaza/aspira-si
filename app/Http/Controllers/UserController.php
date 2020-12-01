<?php

namespace App\Http\Controllers;

use App\Aspiration;
use App\EntitasSi;
use App\Mahasiswa;
use App\User;
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

    public function edit($id){
        $mahasiswa = Mahasiswa::find($id);
        return view('users.edit',['mahasiswa'=>$mahasiswa]);
    }

    public function update(Request $request){
        $mahasiswa = Mahasiswa::find(session(0)->id_mahasiswa);
        if (Mahasiswa::validatePassword(session(0)->id_mahasiswa,$request->old_password)){
            $mahasiswa->password = $request->new_password;
        }else{
            return redirect()->back();
        }
        $mahasiswa->save();
        return redirect(route('profile',session(0)->id_mahasiswa));
    }

//    user management
    public function getAllData(){
        $mahasiswa = Mahasiswa::all();
        $entitas_si = EntitasSi::all();
        return view('bpm.user_management',['mahasiswa'=>$mahasiswa,'entitas'=>$entitas_si]);
    }

    public function updateDataEntitas($id, Request $request){
        $entitas = EntitasSi::find($id);
        if (isset($request->status_entitas)){
            $entitas->status = $request->status_entitas;
        }
        $entitas->nama_entitas = $request->nama_entitas;
        $entitas->username = $request->username_entitas;
        $entitas->save();
        return redirect(route('user_management'));
    }

    public function resetPasswordEntitas($id){
        $entitas = EntitasSi::find($id);
        $entitas->password = 'root';
        $entitas->save();
        return redirect(route('user_management'));
    }

    public function hapusDataEntitas($id){
        $entitas = EntitasSi::find($id);
        $entitas->delete();
        return redirect(route('user_management'));
    }
}
