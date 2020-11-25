<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Bpm;
use App\EntitasSi;

class LoginController extends Controller
{
    public function index(){
        if (session('loginStatus')){
            return redirect(route('feed'));
        }else{
            return view('Login.login');
        }
    }

    public function login(Request $request){
//        dd($request->all());

        $username = $request->username;
        $password = $request->password;

        //cek if mhs
        //cek if entity
        //cek if bpm

        if (Mahasiswa::isExisted($username)){
            if (Mahasiswa::isValidated($username,$password)){
                $user = Mahasiswa::where('username',$username)->get();
                session()->put($user->all());
                session()->put(['loginStatus' => true]);
//                dd(session()->all());
//                return redirect('/feed');
                return redirect(\URL::previous());
            }else{
                return redirect('/');
            }
        }elseif ( EntitasSi::isExisted($username) ){
            if (EntitasSi::isValidated($username,$password)){
                $user = EntitasSi::where('username',$username)->get();
                session()->put($user->all());
                session()->put(['loginStatus' => true]);
                return redirect(\URL::previous());
            }else{
                return redirect('/');
            }
        }elseif ( Bpm::isExisted($username)){
            if (Bpm::isValidated($username,$password)){
                $user = Bpm::where('username',$username)->get();
                session()->put($user->all());
                session()->put(['loginStatus' => true]);
                return redirect(\URL::previous());
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }

    }

    public function lupaPassword(){
        if (!session('loginStatus')){
            return view('Login.forgot-password');
        }
        return redirect(route('feed'));
    }

    public function validateLupaPassword(Request $request){
        $username = $request->username;
        $nama_mahasiswa = $request->nama_mahasiswa;
        $mahasiswa = Mahasiswa::where('username',$username)->first();
        if (Mahasiswa::validateUsername($username,$nama_mahasiswa)){
            return redirect(route('edit_lupa_password',$mahasiswa->id_mahasiswa));
        }else{
            return redirect()->back();
        }
    }

    public function editPassword($id){
        $mahasiswa = Mahasiswa::find($id);
        return view('Login.new-password',['mahasiswa'=>$mahasiswa]);
    }

    public function saveEditPassword(Request $request){
        $mahasiswa = Mahasiswa::find($request->id_mahasiswa);
        $mahasiswa->password = $request->new_password;
        $mahasiswa->save();
        return redirect('/');
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect(\URL::previous());
    }
}
