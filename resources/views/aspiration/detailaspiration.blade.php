@extends('templates/template')

@include('templates.navbar')

@section('title','Aspiration')

@section('container')
    @if(Session::has('message'))
        <div class="alert {{session('messageType')}} alert-dismissible fade show" role="alert" id="alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session("message")}}
        </div>
        {{session()->forget('message')}}
    @endif

    <section class="container mt-5">
        <div class="row">
            @if($aspirasi->status == 'Belum Diproses')
                <div class="col-9 mb-4">
                    <h5>
                        <button onClick="window.history.back();" style="border: none;background-color: transparent;">
                            <img
                                style="width: 30px;" src="{{asset('assets/icon/arrow-left-short.svg')}}" alt="">Back
                        </button>
                    </h5>
                </div>
                @if(session(0)->getTable() == "mahasiswa")
                    <div class="col-2 mb-4">
                        <a href="" class="btn btn-outline-info"
                           data-target="#modalupdate{{$aspirasi->id_aspirasi}}"
                           data-toggle="modal">Update</a>
                    </div>
                @endif
            @else
                <div class="col-12 mb-4">
                    <h5>
                        <button onClick="window.history.back();" style="border: none;background-color: transparent;">
                            <img
                                style="width: 30px;" src="{{asset('assets/icon/arrow-left-short.svg')}}" alt="">Back
                        </button>
                    </h5>
                </div>
            @endif
        </div>
        <div class="row mb-4">
            <div class="col-lg-10 col-md-10 col-sm-12">
                <div class="card aspiration-card">
                    <div class="card-header aspiration-card-header">
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <h3>
                                    <a href="{{route('detailAspiration',[$aspirasi->id_aspirasi])}}">{{$aspirasi->judul_aspirasi}}</a>
                                </h3>
                                <span class="span-time">Posted on September, {{$aspirasi -> created_at}}</span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 text-sm-right mt-3">
                                <h5><span class="badge badge-primary rounded-pill">{{$aspirasi->status}}</span></h5>
                                @if(session(0)->getTable() != 'bpm' && session(0)->getTable() != 'entitas_si')
                                    <button class="btn btn-sm btn-outline-danger"
                                            onclick="addDisLikes({{session(0)->id_mahasiswa}},{{$aspirasi->id_aspirasi}})">
                                        <img
                                            src="{{asset('assets/icon/hand-thumbs-down.svg')}}" class="img-icon"
                                            alt=""><span
                                            id="totalDisLikes{{$aspirasi->id_aspirasi}}"
                                            data-count="{{$aspirasi->downVoteCount}}"
                                            data-max-count="1">{{$aspirasi -> downvote}}</span>
                                    </button>
                                    <button class="btn btn-sm btn-primary"
                                            onclick="addLikes({{session(0)->id_mahasiswa}},{{$aspirasi->id_aspirasi}})">
                                        <img
                                            src="{{asset('assets/icon/hand-thumbs-up.svg')}}" class="img-icon"
                                            alt=""><span
                                            id="totalLikes{{$aspirasi->id_aspirasi}}"
                                            data-count="{{$aspirasi->upVoteCount}}"
                                            data-max-count="1">{{$aspirasi -> upvote}}</span>
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-outline-danger" disabled><img
                                            src="{{asset('assets/icon/hand-thumbs-down.svg')}}" class="img-icon"
                                            alt=""><span>{{$aspirasi -> downvote}}</span>
                                    </button>
                                    <button class="btn btn-sm btn-primary" disabled><img
                                            src="{{asset('assets/icon/hand-thumbs-up.svg')}}" class="img-icon"
                                            alt=""><span>{{$aspirasi -> upvote}}</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body aspiration-card-body">
                        <div class="aspiration-card-body-content">
                            <div class="row mb-4">
                                <div class="col-1 col">
                                    <img alt="" class="img-thumbnail img-icon d-none d-lg-block d-md-block"
                                         src="../assets/img/telkom.jpg" style="width: 50px">
                                </div>
                                <div class="col-11 col">
                                    <span class="span-asal usernamePengirim">{{$aspirasi->username}}</span>
                                    <br>
                                    <span class="span-tujuan">Kepada: {{$aspirasi->nama_entitas}}</span>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-10 col-md-10 col-sm-12">
                                    <p>
                                        {{$aspirasi -> aspirasi_text}}
                                    </p>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12">
                                    @if(isset($aspirasi->file_name))
                                        <a href="" class="btn btn-outline-info"
                                           data-target="#modalFile{{$aspirasi->id_aspirasi}}" data-toggle="modal">File
                                            Pendukung</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer aspiration-card-footer">
                        @if(session(0)->getTable() == 'mahasiswa')
                            <div class="row">
                                <div class="col-1 d-none d-lg-block d-md-block">
                                    <img alt="" class="img-thumbnail img-icon img-icon"
                                         src="{{asset("assets/img/telkom.jpg")}}"
                                         style="width: 50px;">
                                </div>
                                <div class="col-11 col">
                                    <form action="{{route('comment')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="id_aspirasi" value="{{$aspirasi->id_aspirasi}}">
                                            <input type="hidden" name="id_mahasiswa"
                                                   value="{{session(0)->id_mahasiswa}}">
                                            <div class="col-11">
                                                <textarea class="form-control aspiration-comments"
                                                          placeholder="add comments"
                                                          style="resize: none" rows="1" name="text_comment"
                                                          type="text"></textarea>
                                            </div>
                                            <div class="col-1  px-0">
                                                <button type="submit" class="btn p-0">
                                                    <img alt="" class="img-thumbnail img-icon"
                                                         src="{{asset('assets/icon/arrow-right-short.svg')}}"
                                                         style="width: 50px;">
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12">
                @if(isset($aspirasi->file_name))
                    <h5>File Pendukung</h5>
                    <?php
                    foreach (json_decode($aspirasi->file_name) as $file){ ?>
                    <a href="{{asset('files/'.$file)}}" target="_blank"
                       class="btn btn-outline-info mb-2">Name: <?php echo $file?></a>
                    <?php } ?>
                @else
                    <h6 class="mt-5">Tidak Ada File Pendukung</h6>
                @endif
            </div>
        </div>

        @if(!$replys -> isEmpty())
            <h5 class="mt-5">
                Komentar
            </h5>
            @foreach($replys as $reply)
                <div class="row mt-3 mb-3">
                    <div class="col-lg-10 col-md-10 col-sm-12">
                        <div class="card aspiration-card">
                            <div class="card-footer aspiration-card-footer">
                                <div class="row">
                                    <div class="col-1 d-none d-lg-block d-md-block">
                                        <img alt="" class="img-thumbnail img-icon img-icon"
                                             src="{{asset("assets/img/telkom.jpg")}}"
                                             style="width: 50px;">
                                    </div>
                                    @if(session(0)->id_mahasiswa == $reply->id_mahasiswa)
                                        <div class="col-10 col">
                                            <input class="form-control aspiration-comments" placeholder="add comments"
                                                   type="text" disabled value="{{$reply->username}}">
                                        </div>
                                        <div class="col-1 p-0">
                                            <div>
                                                <a href="{{route('deleteReply',[$aspirasi->id_aspirasi])}}"
                                                   class="btn btn-outline-danger align-self-center m-0 h-100"><img
                                                        src="{{asset('assets/icon/trash.svg')}}" alt=""></a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-11 col">
                                            <input class="form-control aspiration-comments" placeholder="add comments"
                                                   type="text" disabled value="{{$reply->username}}">
                                        </div>
                                    @endif
                                    <div class="col-12 col mt-2">
                                    <textarea name="comment" id="comment" class="form-control aspiration-comments"
                                              style="resize: none" disabled>{{$reply->reply_text}}</textarea>
                                    </div>
                                    <div class="col-12 col mt-8">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h6 class="mt-5">
                Belum ada Komentar
            </h6>
    @endif
    <!--End of Aspiration Card-->
    </section>



    @if(session(0)->getTable() != 'bpm' or session(0)->getTable() != 'entitas_si')
        <script src="{{asset('assets/dist/js/vote.js')}}">
        </script>


    @endif

    <div class="modal fade" id="modalupdate{{$aspirasi->id_aspirasi}}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update
                        Aspirasi {{$aspirasi->judul_aspirasi}}</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('updateAspiration',$aspirasi->id_aspirasi)}}" method="post"
                          enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id_mahasiswa" value="{{session(0)->id_mahasiswa}}">
                        {{--                    <input type="hidden" name="id_entitas" value="2">--}}
                        <input type="hidden" name="status" value="Belum Diproses">
                        <label for="judulAspirasi">Judul Aspisrasi</label>
                        <input class="form-control" name="judul_aspirasi" id="judulAspirasi"
                               placeholder="Tuliskan Judul Aspirasi" type="text" required
                               value="{{$aspirasi->judul_aspirasi}}">
                        <label for="tujuanAspirasi">Tujuan Aspirasi</label>
                        <select name="id_entitas" id="tujuanAspirasi" class="form-control" required>
                            @foreach($entitas as $ent)
                                @if($aspirasi->id_entitas == $ent->id_entitas)
                                    <option value="{{$aspirasi->id_entitas}}"
                                            selected>{{$ent->nama_entitas}}</option>
                                @else
                                    <option value="{{$ent -> id_entitas}}">{{$ent -> nama_entitas}}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="textAspirasi">Teks Aspirasi</label>
                        <textarea class="form-control" name="aspirasi_text" id="textAspirasi" cols="30" rows="10"
                                  required>{{$aspirasi->aspirasi_text}}</textarea>

                        <label for="file">File Pendukung
                            <label class="text-danger">*optional</label>
                        </label>
                        <input class="form-control-file" id="file" multiple type="file" name="file_name[]">

                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Update</button>
                            <button class="btn btn-outline-secondary btn-block" data-dismiss="modal"
                                    type="button">Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
