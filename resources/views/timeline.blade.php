@extends('templates/template')

@section('title','Feed')
{{--{{dd($notifikasiByUser)}}--}}

@include('templates.navbar', ['notifikasiByUser' => $notifikasiByUser])

@section('container')
    @if(Session::has('message'))
        <div class="alert {{session('messageType')}} alert-dismissible fade show" role="alert" id="alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session("message")}}
        </div>
        {{session()->forget('message')}}
    @endif

    <section class="container  mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <form action="" class="text-right">
                    <select name="" id="sortByOption" class="btn-sm btn btn-primary">
                        <option value="terbaru" {{ Route::currentRouteNamed('feed') ? 'selected' : '' }}>
                            Terbaru
                        </option>
                        <option value="teratas" {{ Route::currentRouteNamed('feedPopular') ? 'selected' : '' }}>
                            Teratas
                        </option>
                    </select>
                </form>
            </div>
        </div>
        @foreach($aspirasi as $asp)
            <div class="row justify-content-center mb-4">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card aspiration-card">
                        <div class="card-header aspiration-card-header">
                            <div class="row">
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <h3>
                                        <a href="{{route('detailAspiration',[$asp->id_aspirasi])}}">{{$asp->judul_aspirasi}}</a>
                                    </h3>
                                    <span class="span-time">Posted on September, {{$asp -> created_at}}</span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 text-sm-right mt-3">
                                    <h5><span class="badge badge-primary rounded-pill">{{$asp->status}}</span></h5>
                                    @if(session(0)->getTable() != 'bpm' && session(0)->getTable() != 'entitas_si')
                                        <button class="btn btn-sm btn-outline-danger"
                                                onclick="addDisLikes({{session(0)->id_mahasiswa}},{{$asp->id_aspirasi}})">
                                            <img
                                                src="{{asset('assets/icon/hand-thumbs-down.svg')}}" class="img-icon"
                                                alt=""><span
                                                id="totalDisLikes{{$asp->id_aspirasi}}"
                                                data-count="{{$asp->downVoteCount}}"
                                                data-max-count="1">{{$asp -> downvote}}</span>
                                        </button>
                                        <button class="btn btn-sm btn-primary"
                                                onclick="addLikes({{session(0)->id_mahasiswa}},{{$asp->id_aspirasi}})">
                                            <img
                                                src="{{asset('assets/icon/hand-thumbs-up.svg')}}" class="img-icon"
                                                alt=""><span
                                                id="totalLikes{{$asp->id_aspirasi}}" data-count="{{$asp->upVoteCount}}"
                                                data-max-count="1">{{$asp -> upvote}}</span>
                                        </button>
                                    @else
                                        <button class="btn btn-sm btn-outline-danger" disabled><img
                                                src="{{asset('assets/icon/hand-thumbs-down.svg')}}" class="img-icon"
                                                alt=""><span>{{$asp -> downvote}}</span>
                                        </button>
                                        <button class="btn btn-sm btn-primary" disabled><img
                                                src="{{asset('assets/icon/hand-thumbs-up.svg')}}" class="img-icon"
                                                alt=""><span>{{$asp -> upvote}}</span>
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
                                        <span class="span-asal usernamePengirim">{{$asp->username}}</span>
                                        <br>
                                        <span class="span-tujuan">Kepada: {{$asp->nama_entitas}}</span>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-10 col-md-10 col-sm-12">
                                        <p>
                                            {{$asp -> aspirasi_text}}
                                        </p>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12">
                                        @if(isset($asp->file_name))
                                            <a href="" class="btn btn-outline-info"
                                               data-target="#modalFile{{$asp->id_aspirasi}}" data-toggle="modal">File
                                                Pendukung</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer aspiration-card-footer">
                            <div class="row">
                                @if(session(0)->getTable() == 'mahasiswa')
                                    <div class="col-1 d-none d-lg-block d-md-block">
                                        <img alt="" class="img-thumbnail img-icon img-icon" src="{{asset("assets/img/telkom.jpg")}}"
                                             style="width: 50px;">
                                    </div>
                                    @if($asp->comment == null)
                                        <div class="col-11 col">
                                            <form action="{{route('comment')}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="id_aspirasi"
                                                           value="{{$asp->id_aspirasi}}">
                                                    <input type="hidden" name="id_mahasiswa"
                                                           value="{{session(0)->id_mahasiswa}}">
                                                    <div class="col-11">
                                                        <textarea class="form-control aspiration-comments"
                                                          placeholder="add comments"
                                                          style="resize: none" rows="1" name="text_comment"
                                                          id="text_comment"
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
                                    @else
                                        <div class="col-10 col">
                                            <div class="aspiration-comments-exist">
                                                <h6>{{session(0)->nama_mahasiswa}}</h6>
                                                <span>{{$asp->comment}}</span>
                                            </div>
                                        </div>
                                        <div class="col-1 p-0">
                                            <div>
                                                <a href="{{route('deleteReply',[$asp->id_aspirasi])}}"
                                                   class="btn btn-outline-danger align-self-center m-0 h-100"><img
                                                        src="{{asset('assets/icon/trash.svg')}}" alt=""></a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <div class="col-12 text-right mt-2">
                                    <a href="{{route('detailAspiration',[$asp->id_aspirasi])}}">see more
                                        comments</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
    <!--End of Aspiration Card-->
    </section>

    @if(session('0')->getTable() == 'mahasiswa')
        <button class="btn btn-primary feb btn-lg rounded-circle" data-target="#exampleModalCenter" data-toggle="modal">
            +
        </button>
    @endif


    <!--MODAL ADD-->
    <div aria-hidden="true" aria-labelledby="exampleModalCenterTitle" class="modal fade" id="exampleModalCenter"
         role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Aspiration</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/PostAspiration" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_mahasiswa" value="{{session(0)->id_mahasiswa}}">
                        {{--                    <input type="hidden" name="id_entitas" value="2">--}}
                        <input type="hidden" name="status" value="Belum Diproses">
                        <label for="judulAspirasi">Judul Aspisrasi</label>
                        <input class="form-control" name="judul_aspirasi" id="judulAspirasi"
                               placeholder="Tuliskan Judul Aspirasi" type="text" required>
                        <label for="tujuanAspirasi">Tujuan Aspirasi</label>
                        <select name="id_entitas" id="tujuanAspirasi" class="form-control" required>
                            @foreach($entitas as $ent)
                                <option value="{{$ent -> id_entitas}}">{{$ent -> nama_entitas}}</option>
                            @endforeach
                        </select>
                        <label for="textAspirasi">Teks Aspirasi</label>
                        <textarea class="form-control" name="aspirasi_text" id="textAspirasi" cols="30" rows="10"
                                  required></textarea>
                        <label for="file">File Pendukung
                            <label class="text-danger">*optional</label>
                        </label>
                        <input class="form-control-file" id="file" multiple type="file" name="file_name[]">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-primary" type="submit">Post Aspiration</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($aspirasi as $asp)
        @if(isset($asp->file_name))
            <div aria-hidden="true" aria-labelledby="modalFile{{$asp->id_aspirasi}}" class="modal fade"
                 id="modalFile{{$asp->id_aspirasi}}"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">File Pendukung</h5>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Download</span> <br>
                            <?php
                            foreach (json_decode($asp->file_name) as $file){ ?>
                            <a href="{{asset('files/'.$file)}}" target="_blank"
                               class="btn btn-outline-info">Name: <?php echo $file?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach


    <script !src="">
        document.getElementById('sortByOption').addEventListener('change', function (e) {
            if (e.target.value == 'teratas') {
                refreshTeratas();
            } else {
                refreshTerbaru();
            }
        })

        function refreshTerbaru() {
            let url = "{{ route('feed')}}";
            document.location.href = url;
        }

        function refreshTeratas() {
            let url = "{{ route('feedPopular')}}";
            document.location.href = url;
        }
    </script>
    @if(session(0)->getTable() != 'bpm' or session(0)->getTable() != 'entitas_si')
        <script src="{{asset('assets/dist/js/vote.js')}}">
        </script>
    @endif


@endsection

