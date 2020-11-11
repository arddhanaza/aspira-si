<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ReplyAspiration extends Model
{
    protected $table = 'reply';
    protected $primaryKey = ['id_mahasiswa','id_aspirasi'];

    protected function postComment($data)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s');
        $validate = DB::table('reply')
            ->where('id_aspirasi','=',$data['id_aspirasi'])
            ->where('id_mahasiswa','=',$data['id_mahasiswa'])
            ->get();
        if ($validate -> isEmpty()){
            $insert = DB::table('reply')
                ->insert(['id_mahasiswa' => $data['id_mahasiswa'],'id_aspirasi'=>$data['id_aspirasi'],'reply_text'=>$data['text_comment'],'created_at' => $date]);
        }else{
            return false;
        }
        return $insert;
    }

    protected static function getReplyById($id){
        $data = DB::table('reply')
            ->join('aspirasi', 'reply.id_aspirasi', '=', 'aspirasi.id_aspirasi')
            ->join('mahasiswa', 'reply.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->select('reply.*', 'mahasiswa.username')
            ->orderBy('created_at', 'desc')
            ->where('reply.id_aspirasi','=',$id)
            ->get();

        for ($row = 0; $row < count($data); $row++) {
            $newData = Aspiration::changeElement($data[$row]->username);
            $data[$row]->username = $newData;
            $data[$row]->upvote = VoteAspiration::getTotalUpVote($data[$row]->id_aspirasi);
            $data[$row]->downvote = VoteAspiration::getTotalDownVote($data[$row]->id_aspirasi);
        }
        return $data;
    }

    protected static function getReplyByIdAndUser($id,$user){
        $data = DB::table('reply')
            ->join('aspirasi', 'reply.id_aspirasi', '=', 'aspirasi.id_aspirasi')
            ->join('mahasiswa', 'reply.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->select('reply.reply_text')
            ->where('reply.id_aspirasi','=',$id)
            ->where('reply.id_mahasiswa','=',$user)
            ->get();

        return $data;
    }


}
