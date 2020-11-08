<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcement';
    protected $primaryKey = 'id_announcement';

    protected function aspiration(){
        return $this->belongsTo('App\Model\Aspiration','id_aspirasi');
    }

}
