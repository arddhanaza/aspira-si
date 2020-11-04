<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected static function isExisted($username){
        $data = DB::table('mahasiswa')
            ->where('username','=',$username)
            ->get();
        if (!$data -> isEmpty()){
            return true;
        }else{
            return false;
        }
    }


    public function getTable(){
        return $this->table;
    }

    protected static function isValidated($username,$password){
        $data = DB::table('mahasiswa')
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
