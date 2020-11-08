<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VoteAspiration extends Model
{
    protected $table = 'vote_aspirasi';
    protected $primaryKey = ['id_mahasiswa','id_aspirasi'];

    protected static function getTotalUpVote($id){
        return DB::table('vote_aspirasi')
            ->select('upvote')
            ->where('id_aspirasi', '=' , $id)
            ->sum('upvote');
    }

    protected static function getTotalDownVote($id){
        return DB::table('vote_aspirasi')
            ->select('downvote')
            ->where('id_aspirasi', '=' , $id)
            ->sum('downvote');
    }

    protected static function getVoteByIdUser($id,$idm){
        return DB::table('vote_aspirasi')
            ->select('upvote','downvote')
            ->where('id_aspirasi','=',$id)
            ->where('id_mahasiswa','=',$idm)
            ->get();
    }

    protected static function belumVote($id_mahasiswa,$id_aspirasi){
        $data = DB::table('vote_aspirasi')
            ->where('id_aspirasi','=',$id_aspirasi)
            ->where('id_mahasiswa','=',$id_mahasiswa)
            ->get();
        if ($data -> isEmpty()){
            return true;
        }else{
            return false;
        }
    }

    protected static function giveUpVote($id_mahasiswa,$id_aspirasi){
        $validate = self::belumVote($id_mahasiswa,$id_aspirasi);
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s');
        if ($validate){
            return DB::table('vote_aspirasi')
                ->insert(['id_mahasiswa' => $id_mahasiswa,'id_aspirasi'=>$id_aspirasi,'upvote'=>1,'created_at'=>$date]);
        }else{
            return DB::table('vote_aspirasi')
                ->where(['id_mahasiswa' => $id_mahasiswa,'id_aspirasi'=>$id_aspirasi])
                ->update(['upvote'=>1,'downvote'=>0,'updated_at'=>$date]);
        }
    }

    protected static function giveDownVote($id_mahasiswa,$id_aspirasi){
        $validate = self::belumVote($id_mahasiswa,$id_aspirasi);
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s');
        if ($validate){
            return DB::table('vote_aspirasi')
                ->insert(['id_mahasiswa' => $id_mahasiswa,'id_aspirasi'=>$id_aspirasi,'downvote'=>1,'created_at'=>$date]);
        }else{
            return DB::table('vote_aspirasi')
                ->where(['id_mahasiswa' => $id_mahasiswa,'id_aspirasi'=>$id_aspirasi])
                ->update(['upvote'=>0,'downvote'=>1,'updated_at'=>$date]);
        }
    }

}
