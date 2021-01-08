<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';

    public static function postNotifikasi($id_aspirasi,$teks_notifikasi,$tipe_notifikasi){
        return DB::table('notifikasi')
            ->insert([
                'id_aspirasi' => $id_aspirasi,
                'teks_notifikasi' => $teks_notifikasi,
                'tipe_notifikasi' => $tipe_notifikasi
            ]);
    }

    public static function getNotifikasiByUser(){
        $id_user = session(0)->id_mahasiswa;
        $notifikasi = DB::table('notifikasi')
                    ->select('aspirasi.judul_aspirasi','teks_notifikasi','aspirasi.id_aspirasi')
                    ->join('aspirasi','aspirasi.id_aspirasi','=','notifikasi.id_aspirasi')
                    ->where('aspirasi.id_mahasiswa','=',$id_user)
                    ->where('notifikasi.tipe_notifikasi','=','update_status_aspirasi')
                    ->orWhere('notifikasi.tipe_notifikasi','=','finalisasi_status_aspirasi')
                    ->orderBy('notifikasi.created_at','desc')
                    ->get();
//        dd($notifikasi);
        return $notifikasi;
    }

    public static function getNotificationByEntitas(){
        $id_user = session(0)->id_entitas;
        $notifikasi = DB::table('notifikasi')
            ->select('aspirasi.judul_aspirasi','teks_notifikasi','aspirasi.id_aspirasi')
            ->join('aspirasi','aspirasi.id_aspirasi','=','notifikasi.id_aspirasi')
            ->where('aspirasi.id_entitas','=',$id_user)
            ->where('notifikasi.tipe_notifikasi','=','aspirasi_diteruskan')
            ->orderBy('notifikasi.created_at','desc')
            ->get();
//        dd($notifikasi);
        return $notifikasi;
    }

    public static function getNotificationByBpm(){
        $notifikasi = DB::table('notifikasi')
            ->select('aspirasi.judul_aspirasi','teks_notifikasi','aspirasi.id_aspirasi')
            ->join('aspirasi','aspirasi.id_aspirasi','=','notifikasi.id_aspirasi')
            ->where('notifikasi.tipe_notifikasi','=','aspirasi_baru')
            ->orderBy('notifikasi.created_at','desc')
            ->get();
//        dd($notifikasi);
        return $notifikasi;
    }

    public static function deleteByUser(){
        $role = session(0)->getTable();
        if ($role == 'mahasiswa'){
            return DB::table('notifikasi')
                ->join('aspirasi','aspirasi.id_aspirasi' ,'=' ,'notifikasi.id_aspirasi')
                ->where('aspirasi.id_mahasiswa' ,'=',session(0)->id_mahasiswa)
                ->where('notifikasi.tipe_notifikasi','=','update_status_aspirasi')
                ->delete();
        }elseif ($role == 'bpm'){
            return DB::table('notifikasi')
                ->where('tipe_notifikasi' ,'=','aspirasi_baru')
                ->delete();
        }else{
            return DB::table('notifikasi')
                ->where('tipe_notifikasi' ,'=','aspirasi_diteruskan')
                ->delete();
        }
    }
}
