<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bpm extends Model
{
    protected $table = 'bpm';
    protected $primaryKey = 'id_bpm';

    protected static function isExisted($username){
        $data = DB::table('bpm')
            ->where('username','=',$username)
            ->get();
        if (!$data -> isEmpty()){
            return true;
        }else{
            return false;
        }
    }

    protected static function isValidated($username,$password){
        $data = DB::table('bpm')
            ->where([
                ['username',$username],
                ['password',$password],
            ])
            ->get();

        if (!$data -> isEmpty()){
            return true;
        }else{
            return false;
        }
    }
}
