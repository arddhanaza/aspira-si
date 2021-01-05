<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Aspiration;
use App\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index(){
        $announcements = Announcement::getAnnouncementByIdUser(session(0)->id_entitas);
        $aspirasi = Aspiration::getAspirasiByIdEntitas(session(0)->id_entitas);
        $notifikasi = Notifikasi::getNotificationByEntitas();
        return view('announcement.announcement',['announcements' => $announcements,'aspirasi'=>$aspirasi,'notifikasiByUser'=>$notifikasi]);
    }

    public function getAllAnnouncement(){

        $announcements = Announcement::getAllData();
        $notifikasi = Notifikasi::getNotifikasiByUser();
        return view('users.announcement',['announcements' => $announcements,'notifikasiByUser'=>$notifikasi]);
    }

    public function destroy($id){
        $announcement = Announcement::find($id);
        $id_aspirasi = $announcement->id_aspirasi;
        if (isset($id_aspirasi)){
            $aspirasi = Aspiration::find($id_aspirasi);
            $aspirasi->status = 'Diteruskan';
            $aspirasi->save();
        }
        $announcement->delete();
        session()->put(['message'=>"Announcemnt berhasil dihapus","messageType"=>'alert-danger']);
        return redirect(route('announcement'));
    }

    public function store(Request $request){
        $announcement = new Announcement();
        $announcement->id_entitas = $request->id_entitas;
        if (isset($request->judul_aspirasi)){
            $announcement->id_aspirasi = $request->judul_aspirasi;
        }
        if($request->hasfile('file_name'))
        {
            foreach($request->file('file_name') as $file)
            {
                $name = time().'.'.$file->extension();
                $file->move(public_path().'/files/', $name);
                $data[] = $name;
            }
            $announcement->nama_file = json_encode($data);
        }
        $announcement->announcement_text = $request->announcement_text;
        $announcement->save();

        $id_aspirasi = $request->judul_aspirasi;
        DB::table('aspirasi')
            -> where('id_aspirasi', '=', $id_aspirasi)
            -> update(['status' => 'Done Resolved']);

        session()->put(['message'=>"Announcemnt berhasil ditambahkan","messageType"=>'alert-success']);
        return redirect(route('announcement'));
    }

    public function edit($id){
        $announcement = Announcement::find($id);
        $aspirasi = Aspiration::getAspirasiByIdEntitas(session(0)->id_entitas);
        $notifikasi = Notifikasi::getNotificationByEntitas();
        return view('announcement.editAnnouncement',['announcement' => $announcement,'aspirasi'=>$aspirasi,'notifikasiByUser'=>$notifikasi]);
    }

    public function update(Request $request){
        $announcement = Announcement::find($request->id_announcement);
        if (isset($request->judul_aspirasi)){
            $announcement->id_aspirasi = $request->judul_aspirasi;
        }

        if($request->hasfile('file_name')) {
            foreach($request->file('file_name') as $file)
            {
                $name = time().'.'.$file->extension();
                $file->move(public_path().'/files/', $name);
                $data[] = $name;
            }
            $announcement->nama_file = json_encode($data);
        }

        $announcement->announcement_text = $request->announcement_text;
        $announcement->save();
        session()->put(['message'=>"Announcemnt berhasil diupdate","messageType"=>'alert-warning']);
        return redirect(route('announcement'));

    }
}
