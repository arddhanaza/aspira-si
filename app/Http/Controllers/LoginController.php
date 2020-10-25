<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Bpm;
use App\EntitasSi;

class LoginController extends Controller
{
    public function index(){
        return view('Login.login');
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
                return redirect('/feed');
            }else{
                return redirect('/');
            }
        }elseif ( EntitasSi::isExisted($username) ){
            if (EntitasSi::isValidated($username,$password)){
                $user = EntitasSi::where('username',$username)->get();
                session()->put($user->all());
                return redirect('/feed');
            }else{
                return redirect('/');
            }
        }elseif ( Bpm::isExisted($username)){
            if (Bpm::isValidated($username,$password)){
                $user = Bpm::where('username',$username)->get();
                session()->put($user->all());
                return redirect('/feed');
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }

    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
}
