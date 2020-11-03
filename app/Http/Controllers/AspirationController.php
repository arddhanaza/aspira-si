<?php

namespace App\Http\Controllers;

use App\Aspiration;
use App\EntitasSi;
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
        return view('timeline', ['aspirasi' => $aspirasi , 'entitas' => $entitas]);
    }

    public function feedPopular(){
        $aspirasi = Aspiration::getAspirationByPopular();
        $entitas = EntitasSi::getDataEntitas();
        return view('timeline', ['aspirasi' => $aspirasi , 'entitas' => $entitas]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aspirasi = new Aspiration;

//        $this->validate($request, [
//            'file_name' => 'required',
//            'file_name.*' => 'mimes:doc,pdf,docx,zip,jpeg,jpg,png'
//        ]);

        if($request->hasfile('file_name'))
        {
            foreach($request->file('file_name') as $file)
            {
                $name = time().'.'.$file->extension();
                $file->move(public_path().'/files/', $name);
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

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
