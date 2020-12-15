<?php

namespace App\Http\Controllers;

use App\Notifikasi;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class NotifikasiController extends Controller
{
    public function index(){

    }

    public function getNotification(){

    }

    public function store($id,$notifikasiteks,$notifikasistatus){
//        $notifikasi = new Notifikasi();
//        $notifikasi->id_aspirasi = $id;
//        $notifikasi->teks_notifikasi = $notifikasiteks;
//        $notifikasi->status_notifikasi = $notifikasistatus;
//        $notifikasi->save();
//        return TRUE;
    }

    public function destroy(){
        $deleted = Notifikasi::deleteByUser();
        return back();
    }
}
