<?php

namespace App\Http\Controllers;

use App\Aspiration;
use App\EntitasSi;
use App\Notifikasi;
use App\ReplyAspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AspirationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aspirasi = Aspiration::getAspiration();
        $entitas = EntitasSi::getDataEntitas();

        if (session(0)->getTable() == 'bpm') {
            $notifikasi = Notifikasi::getNotificationByBpm();
        } elseif (session(0)->getTable() == 'entitas_si') {
            $notifikasi = Notifikasi::getNotificationByEntitas();
        } else {
            $notifikasi = Notifikasi::getNotifikasiByUser();
        }
//        dd($notifikasi);
        return view('timeline', ['aspirasi' => $aspirasi, 'entitas' => $entitas, 'notifikasiByUser' => $notifikasi]);
    }

    public function feedPopular()
    {
        $aspirasi = Aspiration::getAspirationByPopular();
        $entitas = EntitasSi::getDataEntitas();
        if (session(0)->getTable() == 'bpm') {
            $notifikasi = Notifikasi::getNotificationByBpm();
        } elseif (session(0)->getTable() == 'entitas_si') {
            $notifikasi = Notifikasi::getNotificationByEntitas();
        } else {
            $notifikasi = Notifikasi::getNotifikasiByUser();
        }
//        dd($notifikasi);
        return view('timeline', ['aspirasi' => $aspirasi, 'entitas' => $entitas, 'notifikasiByUser' => $notifikasi]);
    }

    public function getAllAspiration()
    {
        $aspirasi = Aspiration::getAllAspiration();
        $notifikasi = Notifikasi::getNotificationByBpm();
        return view('bpm.allAspiration', ['aspirasi' => $aspirasi, 'notifikasiByUser' => $notifikasi]);
    }

    public function getAspirationForYou()
    {

        $aspirasi = Aspiration::getAspirationForYou();
        //    dd($aspirasi);
        $notifikasi = Notifikasi::getNotificationByEntitas();
        return view('bpm.foryou', ['aspirasi' => $aspirasi, 'notifikasiByUser' => $notifikasi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aspirasi = new Aspiration;

//        $this->validate($request, [
//            'file_name' => 'required',
//            'file_name.*' => 'mimes:doc,pdf,docx,zip,jpeg,jpg,png'
//        ]);

        if ($request->hasfile('file_name')) {
            foreach ($request->file('file_name') as $file) {
                $name = time() . '.' . $file->extension();
                $file->move(public_path() . '/files/', $name);
                $data[] = $name;
            }
            $aspirasi->file_name = json_encode($data);
        }

        $aspirasi->id_mahasiswa = $request->id_mahasiswa;
        $aspirasi->id_entitas = $request->id_entitas;
        $aspirasi->judul_aspirasi = $request->judul_aspirasi;
        $aspirasi->aspirasi_text = $request->aspirasi_text;
        $aspirasi->status = $request->status;
        $aspirasi->save();
        $lates_id_aspirasi = Aspiration::latest()->first();
        $id = $lates_id_aspirasi->id_aspirasi;
        $notifikasiTeks = "Aspirasi baru telah dibuat dengan judul $request->judul_aspirasi";
        $notifikasiTipe = "aspirasi_baru";
        $notifikasi = new Notifikasi();
        $notifikasi->postNotifikasi($id, $notifikasiTeks, $notifikasiTipe);
        session()->put(['message'=>"Yeay, kamu berhasil menambahkan Aspirasi dan Saat ini sedang direview oleh BPM","messageType"=>'alert-success']);
        return redirect(route('detailAspiration',$id));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aspirasi = Aspiration::getAspirasiById($id);
        $reply = ReplyAspiration::getReplyById($id);
        $entitas = EntitasSi::getDataEntitas();
        if (session(0)->getTable() == 'bpm') {
            $notifikasi = Notifikasi::getNotificationByBpm();
        } elseif (session(0)->getTable() == 'entitas_si') {
            $notifikasi = Notifikasi::getNotificationByEntitas();
        } else {
            $notifikasi = Notifikasi::getNotifikasiByUser();
        }
        return view('aspiration.detailaspiration', ['aspirasi' => $aspirasi, 'replys' => $reply, 'notifikasiByUser' => $notifikasi,'entitas'=>$entitas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aspirasi = Aspiration::find($id);

        if (isset($request->statusUpdate)) {
            $aspirasi->status = $request->statusUpdate;
            $aspirasi->save();
        }
        if ($request->statusUpdate == 'Diteruskan') {
            $notifikasiTeks = "Aspirasi diteruskan oleh BPM dengan Judul:  $aspirasi->judul_aspirasi";
            $notifikasiTipe = "aspirasi_diteruskan";

            $notifikasi = new Notifikasi();
            $notifikasi->postNotifikasi($id, $notifikasiTeks, $notifikasiTipe);
        }
        $notifikasiTeks = "Status Aspirasi Telah di Update Menjadi $request->statusUpdate";
        $notifikasiTipe = "update_status_aspirasi";
        $notifikasi = new Notifikasi();
        $notifikasi->postNotifikasi($id, $notifikasiTeks, $notifikasiTipe);
        session()->put(['message'=>"Berhasil update status!","messageType"=>'alert-success']);
        return redirect(route('bpmAllAspiration'));
    }

    public function updateApirasiBeforeStatusChange(Request $request, $id){
        $aspirasi = Aspiration::find($id);

        if ($request->hasfile('file_name')) {
            foreach ($request->file('file_name') as $file) {
                $name = time() . '.' . $file->extension();
                $file->move(public_path() . '/files/', $name);
                $data[] = $name;
            }
            $aspirasi->file_name = json_encode($data);
        }

        $aspirasi->id_mahasiswa = session(0)->id_mahasiswa;
        $aspirasi->id_entitas = $request->id_entitas;
        $aspirasi->judul_aspirasi = $request->judul_aspirasi;
        $aspirasi->aspirasi_text = $request->aspirasi_text;
        $aspirasi->save();
        session()->put(['message'=>"Berhasil mengupdate aspirasi","messageType"=>'alert-warning']);
        return redirect(route('detailAspiration',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aspirasi = Aspiration::find($id);
        $aspirasi->delete();
        session()->put(['message'=>"Berhasil menghapus aspirasi","messageType"=>'alert-danger']);
        return redirect(route('bpmAllAspiration'));

    }
}
