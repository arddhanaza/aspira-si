<?php

namespace App\Http\Controllers;

use App\VoteAspiration;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index(){
        return redirect('/feed');
    }

    public function postUpVote($id_mahasiswa,$id_aspirasi){
        VoteAspiration::giveUpVote($id_mahasiswa,$id_aspirasi);
        return $this->index();
    }
    public function postDownVote($id_mahasiswa,$id_aspirasi){
        VoteAspiration::giveDownVote($id_mahasiswa,$id_aspirasi);
        return $this->index();
    }
}
