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
}
