@extends('templates/template')

@include('templates.navbar')

@section('title','Aspiration')

@section('container')

    <section class="container  mt-5">
        <div class="row col-12 mb-4">
            <h5>
                <button onClick="window.history.back();" style="border: none;background-color: transparent;"><img
                        style="width: 30px;" src="{{asset('assets/icon/arrow-left-short.svg')}}" alt="">Back
                </button>
            </h5>
        </div>
        <div class="row mb-4">
            <div class="col-lg-10 col-md-10 col-sm-12">
                <div class="card aspiration-card">
                    <div class="card-header aspiration-card-header">
                        <div class="row">
                            <div class="col-9">
                                <h3>{{$aspirasi->judul_aspirasi}}</h3>
                                <span class="span-time">Posted on September, {{$aspirasi -> created_at}}</span>
                            </div>
                            <div class="col-3 text-right">
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
                                    <img alt="" class="img-thumbnail img-icon" src="../assets/img/telkom.jpg"
                                         style="width: 50px">
                                </div>
                                <div class="col-11 col">
                            <span class="span-asal usernamePengirim">
                                {{$aspirasi -> username}}
                            </span>
                                    <br>
                                    <span class="span-tujuan">
                                Kepada: {{$aspirasi -> nama_entitas}}
                            </span>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <p>
                                        {{$aspirasi -> aspirasi_text}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer aspiration-card-footer">
                        @if(session(0)->getTable() == 'mahasiswa')
                            <div class="row">
                                <div class="col-1 col">
                                    <img alt="" class="img-thumbnail img-icon" src="../assets/img/telkom.jpg"
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
                                            <div class="col-1">
                                                <button type="submit" class="btn py-0">
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
                    <h6>Tidak Ada File Pendukung</h6>
                @endif
            </div>
        </div>

        @if(!$replys -> isEmpty())
            <h5 class="mt-5">
                Komentar
            </h5>
            @foreach($replys as $reply)
                <div class="row mt-3">
                    <div class="col-lg-10 col-md-10 col-sm-12">
                        <div class="card aspiration-card">
                            <div class="card-footer aspiration-card-footer">
                                <div class="row">
                                    <div class="col-1 col">
                                        <img alt="" class="img-thumbnail img-icon" src="../assets/img/telkom.jpg"
                                             style="width: 50px;">
                                    </div>
                                    @if(session(0)->id_mahasiswa == $reply->id_mahasiswa)
                                        <div class="col-9 col">
                                            <input class="form-control aspiration-comments" placeholder="add comments"
                                                   type="text" disabled value="{{$reply->username}}">
                                        </div>
                                        <div class="col-2 m-0 pl-0 text-right">
                                            <a href="{{route('deleteReply',[$aspirasi->id_mahasiswa])}}"
                                               class=" w-100 btn btn-outline-danger align-self-center m-0 h-100">Delete</a>
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

@endsection
