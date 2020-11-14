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
        DB::table('reply')->where('reply.id_aspirasi')->delete();
        return redirect('feed');
    }
}
