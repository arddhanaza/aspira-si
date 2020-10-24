<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyAspiration extends Model
{
    protected $table = 'reply';
    protected $primaryKey = ['id_mahasiswa','id_aspirasi'];
}
