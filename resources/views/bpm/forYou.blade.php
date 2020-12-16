@extends('templates/template')

@include('templates.navbar')

@section('title','For You')

<!-- @section('foryou','active') -->

@section('container')

    <section class="mt-5 container-fluid">
        <!--Start of Aspiration Card-->
        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <div class="card aspiration-card-table">
                    <div class="card-body table-responsive">
                        <table class="table table-striped datTable">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Pengirim</th>
                                <th>Angkatan</th>
                                <th>Judul Aspirasi</th>
                                <th>Aspirasi</th>
                                <th>Tujuan</th>
                                <th>File Pendukung</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($aspirasi as $asp)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$asp->nama_mahasiswa}}</td>
                                    <td>{{$asp->angkatan}}</td>
                                    <td>{{$asp->judul_aspirasi}}</td>
                                    <td>{{$asp->aspirasi_text}}</td>
                                    <td>{{$asp->nama_entitas}}</td>
                                    <td>
                                        @if(isset($asp->file_name))
                                            <a href="" class="btn btn-outline-info"
                                               data-target="#modalFile{{$asp->id_aspirasi}}" data-toggle="modal">File
                                                Pendukung</a>
                                        @else
                                            <span>Tidak Ada File Pendukung</span>
                                        @endif
                                    </td>
                                    <td>{{$asp->created_at}}</td>
                                    <td>{{$asp->status}}</td>
                                    <td>
                                        <a href="{{route('detailAspiration',[$asp->id_aspirasi])}}" class="btn btn-primary mb-2">Detail</a>
                                        <button class="btn btn-outline-info mb-2" data-toggle="modal"
                                                data-target="#modalAnswer{{$asp->id_aspirasi}}">Answer
                                        </button>                                        
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Aspiration Card-->
    </section>

    @foreach($aspirasi as $asp)
        <div class="modal fade" id="modalAnswer{{$asp->id_aspirasi}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Announcement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Judul Aspirasi: <span class="badge badge-pill badge-primary">{{$asp->judul_aspirasi}}</span></h6>
                        <hr>
                        <form action="{{route('post_announcement')}}" method="post" enctype="multipart/form-data">                            
                            @csrf                            
                            <input type="hidden" name="id_entitas" value="{{ session(0)->id_entitas }}">
                            <input type="hidden" name="judul_aspirasi" value="{{ $asp->id_aspirasi }}">
                            <input type="hidden" name="judul_aspirasi" value="{{ $asp->id_aspirasi }}">
                            <div class="form-group">
                                <label for="announcement_text">Teks Announcement</label>
                                <textarea class="form-control" name="announcement_text" cols="30" rows="10"></textarea>                                
                            </div>                
                            <label for="file">File Pendukung
                                <label class="text-danger">*optional</label>
                            </label>
                            <input class="form-control-file" id="file" multiple type="file" name="file_name[]">                               
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Post Announcement</button>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
