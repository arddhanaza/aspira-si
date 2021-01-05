<?php

namespace App\Http\Controllers;

use App\ReplyAspiration;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function index(){
        return true;
    }

    public function store(Request $request){
        if (isset($request->text_comment)){
            $data = $request->all();
            if( ReplyAspiration::postComment($data)){
                session()->put(['message'=>"Berhasil Menambahkan Komentar","messageType"=>'alert-success']);
                return redirect(route('detailAspiration',[$request->id_aspirasi]));
            }else{
                session()->put(['message'=>"Sudah pernah memberikan Komentar","messageType"=>'alert-danger']);
                return redirect()->back();
            }
        }else{
            session()->put(['message'=>"Gagal Menambahkan Komentar","messageType"=>'alert-danger']);
            return redirect()->back();
        }
    }
    public function delete($id_aspirasi){
        ReplyAspiration::where('reply.id_mahasiswa','=',session(0)->id_mahasiswa)->where('reply.id_aspirasi','=',$id_aspirasi)->delete();
        session()->put(['message'=>"Komentar dihapus!","messageType"=>'alert-danger']);
        return redirect('feed');
    }
}
