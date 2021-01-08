<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Expression;

class Aspiration extends Model
{
    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';

    protected static function getAspiration()
    {
        $data = DB::table('aspirasi')
            ->join('mahasiswa', 'aspirasi.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->join('entitas_si', 'aspirasi.id_entitas', '=', 'entitas_si.id_entitas')
            ->select('aspirasi.*', 'mahasiswa.username', 'entitas_si.nama_entitas')
            ->where('aspirasi.status','!=','Done Resolved')
            ->where('aspirasi.status','!=','Belum Diproses')
            ->where('aspirasi.status','!=','On Hold')
            ->orderBy('created_at', 'desc')
            ->get();
        for ($row = 0; $row < count($data); $row++) {
            $newData = self::changeElement($data[$row]->username);
            $upvoteTotal = VoteAspiration::getTotalUpVote($data[$row]->id_aspirasi);
            $downvoteTotal = VoteAspiration::getTotalDownVote($data[$row]->id_aspirasi);
            $vote = VoteAspiration::getVoteByIdUser($data[$row]->id_aspirasi, session(0)->id_mahasiswa);
            if (session(0)->getTable() == 'mahasiswa'){
                $comment = ReplyAspiration::getReplyByIdAndUser($data[$row]->id_aspirasi,session(0)->id_mahasiswa);
                if (!$comment->isEmpty()){
                    $data[$row]->comment = $comment[0]->reply_text;
                }else{
                    $data[$row]->comment = null;
                }
            }
            if (!$vote->isEmpty()) {
                $upvoteCount = $vote[0]->upvote;
                $downvoteCount = $vote[0]->downvote;
                $data[$row]->upVoteCount = $upvoteCount;
                $data[$row]->downVoteCount = $downvoteCount;
            } else {
                $data[$row]->upVoteCount = 0;
                $data[$row]->downVoteCount = 0;
            }
            $data[$row]->username = $newData;
            $data[$row]->upvote = $upvoteTotal;
            $data[$row]->downvote = $downvoteTotal;
        }
        return $data;
    }

    protected static function getAllAspiration()
    {
        $data = DB::table('aspirasi')
            ->join('mahasiswa', 'aspirasi.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->join('entitas_si', 'aspirasi.id_entitas', '=', 'entitas_si.id_entitas')
            ->select('aspirasi.*', 'mahasiswa.username', 'entitas_si.nama_entitas', 'mahasiswa.nama_mahasiswa', 'mahasiswa.angkatan')
            ->orderBy('status','asc')
            ->orderBy('created_at', 'desc')
            ->get();
        return $data;
    }

    protected static function changeElement($data)
    {
        if (session(0)->getTable() == 'mahasiswa' || session(0)->getTable() == 'entitas_si'){
            $x = substr_replace($data, '*****', 0, 5);
            $y = substr_replace($x, '*', 9, 1);
            return $y;
        }else{
            return $data;
        }
    }

    protected static function getAspirationByPopular()
    { //with higher likes
        $data = self::getAspiration()->sortByDesc('upvote');
        return $data;
    }

    protected static function getAspirasiByUser($user)
    {
        $data = DB::table('aspirasi')
            ->join('mahasiswa', 'aspirasi.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->join('entitas_si', 'aspirasi.id_entitas', '=', 'entitas_si.id_entitas')
            ->select('aspirasi.*', 'mahasiswa.username', 'mahasiswa.nama_mahasiswa', 'entitas_si.nama_entitas')
            ->where('mahasiswa.id_mahasiswa', '=', $user)
            ->orderBy('created_at', 'desc')
            ->get();
        for ($row = 0; $row < count($data); $row++) {
            $upvoteTotal = VoteAspiration::getTotalUpVote($data[$row]->id_aspirasi);
            $downvoteTotal = VoteAspiration::getTotalDownVote($data[$row]->id_aspirasi);
            $data[$row]->upvote = $upvoteTotal;
            $data[$row]->downvote = $downvoteTotal;
        }
        return $data;
    }

    protected static function getAspirasiById($id)
    {
        $data = DB::table('aspirasi')
            ->join('mahasiswa', 'aspirasi.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->join('entitas_si', 'aspirasi.id_entitas', '=', 'entitas_si.id_entitas')
            ->select('aspirasi.*', 'mahasiswa.username', 'mahasiswa.nama_mahasiswa', 'entitas_si.nama_entitas')
            ->where('aspirasi.id_aspirasi', '=', $id)
            ->first();
        $vote = VoteAspiration::getVoteByIdUser($data->id_aspirasi, session(0)->id_mahasiswa);
        $newData = self::changeElement($data->username);
        if (!$vote->isEmpty()) {
            $upvoteCount = $vote[0]->upvote;
            $downvoteCount = $vote[0]->downvote;
            $data->upVoteCount = $upvoteCount;
            $data->downVoteCount = $downvoteCount;
        } else {
            $data->upVoteCount = 0;
            $data->downVoteCount = 0;
        }
        $data->upvote = VoteAspiration::getTotalUpVote($data->id_aspirasi);
        $data->downvote = VoteAspiration::getTotalDownVote($data->id_aspirasi);
        $data->username = $newData;
        return $data;
    }

    protected static function getAspirationForYou(){
        $user = session(0)->id_entitas;
        $getAspiration = self::getAllAspiration()
                        -> where('id_entitas','=',$user)
                        -> whereBetween('status',['Diteruskan','Done Resolved'])
                        -> where('status','!=','Ditinjau')
                        -> where('status','!=','On Hold')
                        -> sortBy('status');
//        dd($getAspiration);

        return $getAspiration;

        //sort by status
        //entitas bisa memberikan announcemnet tanpa harus ke tab ann, modal disabled untuk tujuan
        //yg di announ turun dan diubah statusnya jadi done resolved
    }

    protected static function getAspirasiByIdEntitas($id){
        $aspirasi = self::getAllAspiration()
            -> where('id_entitas','=',$id)
            -> where('status','=','Diteruskan');
        return $aspirasi;
    }

}
