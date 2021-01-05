<?php

namespace App\Http\Controllers;

use App\Aspiration;
use App\EntitasSi;
use App\Mahasiswa;
use App\Notifikasi;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Index($user)
    {
        $entitas = EntitasSi::getDataEntitas();
        if ($user != session(0)->id_mahasiswa){
            $aspirasi_mhs = Aspiration::getAspirasiByUser(session(0)->id_mahasiswa);
            $mhs = Mahasiswa::find(session(0)->id_mahasiswa);
            $notifikasi = Notifikasi::getNotifikasiByUser();
            return view('users.profile',['aspirasi_mhs'=>$aspirasi_mhs, 'mhs' => $mhs,'notifikasiByUser'=>$notifikasi, 'entitas' => $entitas]);
        }else{
            $aspirasi_mhs = Aspiration::getAspirasiByUser($user);
            $mhs = Mahasiswa::find($user);
            $notifikasi = Notifikasi::getNotifikasiByUser();
            return view('users.profile',['aspirasi_mhs'=>$aspirasi_mhs, 'mhs' => $mhs,'notifikasiByUser'=>$notifikasi, 'entitas' => $entitas]);
        }
    }

    public function edit($id){
        $mahasiswa = Mahasiswa::find($id);
        $notifikasi = Notifikasi::getNotifikasiByUser();
        return view('users.edit',['mahasiswa'=>$mahasiswa,'notifikasiByUser'=>$notifikasi]);
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
        $notifikasi = Notifikasi::getNotificationByBpm();
        return view('bpm.user_management',['mahasiswa'=>$mahasiswa,'entitas'=>$entitas_si,'notifikasiByUser'=>$notifikasi]);
    }

    public function tambahDataEntitas(Request $request){
        $entitas = new EntitasSi();

        $entitas->nama_entitas = $request->nama_entitas;
        $entitas->status = $request->status_entitas;
        $entitas->username = $request->username_entitas;
        $entitas->password = $request->password_entitas;
        $entitas->save();
        return redirect(route('user_management'));
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

    public function tambahDataMahasiswa(Request $request){
        $mahasiswa = new Mahasiswa();

        $mahasiswa->username = $request->username_mhs;
        $mahasiswa->password = $request->password_mhs;
        $mahasiswa->nama_mahasiswa = $request->nama_mhs;
        $mahasiswa->angkatan = $request->angkatan_mhs;
        $mahasiswa->save();
        return redirect(route('user_management'));
    }

    public function updateDataMahasiswa($id, Request $request){
        $mahasiswa = Mahasiswa::find($id);

        $mahasiswa->username = $request->username_mhs;
        $mahasiswa->nama_mahasiswa = $request->nama_mhs;
        $mahasiswa->angkatan = $request->angkatan_mhs;
        $mahasiswa->save();
        return redirect(route('user_management'));

    }

    public function resetPasswordMahasiswa($id){
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->password = 'root';
        $mahasiswa->save();
        return redirect(route('user_management'));
    }

    public function hapusDataMahasiswa($id){
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();
        return redirect(route('user_management'));
    }
}
