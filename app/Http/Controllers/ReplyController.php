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
                return redirect(route('detailAspiration',[$request->id_aspirasi]));
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
    public function delete($id_aspirasi){
        ReplyAspiration::where('reply.id_mahasiswa','=',session(0)->id_mahasiswa)->where('reply.id_aspirasi','=',$id_aspirasi)->delete();
        session()->put(['message'=>"Komentar dihapus!","messageType"=>'alert-danger']);
        return redirect('feed')->with('toast_success', 'komen dihapus');
    }
}
