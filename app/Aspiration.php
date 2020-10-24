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

    protected function announcement()
    {
        return $this->hasOne('App\Model\Announcement');
    }

    protected function reply()
    {
        return $this->hasMany(ReplyAspiration::class);
    }

    protected function vote()
    {
        return $this->hasMany(VoteAspiration::class);
    }

    protected function entitasSi()
    {
        return $this->belongsTo(EntitasSi::class, 'id_entitas');
    }

    protected function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    protected static function getAspiration()
    {
        $data =  DB::table('aspirasi')
            ->join('mahasiswa', 'aspirasi.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->join('entitas_si', 'aspirasi.id_entitas', '=', 'entitas_si.id_entitas')
            ->select('aspirasi.*', 'mahasiswa.username', 'entitas_si.nama_entitas')
            ->orderBy('created_at','desc')
            ->get();
//        return DB::table('aspirasi')
//            ->join('mahasiswa', 'aspirasi.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
//            ->join('entitas_si', 'aspirasi.id_entitas', '=', 'entitas_si.id_entitas')
//            ->select('aspirasi.*', 'mahasiswa.username', 'entitas_si.nama_entitas')
//            ->get();
        for ($row = 0; $row < count($data); $row++){
            $newData = self::changeElement($data[$row] -> username);
            $upvoteTotal = VoteAspiration::getTotalUpVote($data[$row]->id_aspirasi);
            $downvoteTotal = VoteAspiration::getTotalDownVote($data[$row]->id_aspirasi);
            $data[$row] -> username = $newData;
            $data[$row] -> upvote = $upvoteTotal;
            $data[$row] -> downvote = $downvoteTotal;
        }
        return $data;
    }

    protected static function changeElement($data){
        $x = substr_replace($data,'*****',0,5);
        $y = substr_replace($x,'*',9,1);
        return $y;
    }

}
