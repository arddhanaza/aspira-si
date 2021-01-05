<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Announcement extends Model
{
    protected $table = 'announcement';
    protected $primaryKey = 'id_announcement';

    protected static function getAnnouncementByIdUser($user){
        $data = DB::table('announcement')
            ->select('id_announcement','announcement.id_entitas','id_aspirasi','announcement_text','nama_file','announcement.created_at','nama_entitas','status')
            ->join('entitas_si', 'entitas_si.id_entitas', '=', 'announcement.id_entitas')
            ->where('announcement.id_entitas','=',$user)
            ->orderByDesc('created_at')
            ->get();
        self::updateData($data);
        return $data;
    }
    protected static function updateData($data){
        for ($row = 0;$row<count($data);$row++){
            if (isset($data[$row]->id_aspirasi)){
                $judulAspirasi = DB::table('announcement')
                    ->join('aspirasi', 'aspirasi.id_aspirasi', '=', 'announcement.id_aspirasi')
                    ->where('announcement.id_entitas','=',$data[$row]->id_entitas)
                    ->where('announcement.id_aspirasi','=',$data[$row]->id_aspirasi)
                    ->select('judul_aspirasi')
                    ->first();
                $data[$row] -> judul_aspirasi = $judulAspirasi->judul_aspirasi;
            }else{
                $judulAspirasi = "Tanpa Tujuan";
                $data[$row] -> judul_aspirasi = $judulAspirasi;
            }
        }
    }

    protected static function getAllData(){
        $data = DB::table('announcement')
            ->select('id_announcement','announcement.id_entitas','id_aspirasi','announcement_text','nama_file','announcement.created_at','nama_entitas','status')
            ->join('entitas_si', 'entitas_si.id_entitas', '=', 'announcement.id_entitas')
            ->orderByDesc('announcement.created_at')
            ->get();
        self::updateData($data);
        return $data;
    }
}
