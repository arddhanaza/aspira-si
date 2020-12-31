@extends('templates/template')

@include('templates.navbar')

@section('title','All Aspiration')

@section('container')
    @if(Session::has('message'))
        <div class="alert {{session('messageType')}} alert-dismissible fade show" role="alert" id="alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session("message")}}
        </div>
        {{session()->forget('message')}}
    @endif

<section class="mt-5 container-fluid">
    <!--Start of Aspiration Card-->
    <div class="row justify-content-center mb-4">
        <div class="col-12">
            <div class="card aspiration-card-table">
                <div class="card-header">
                    <h1>Data Aspirasi</h1>
                </div>
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
                                            <a href="" class="btn btn-outline-info" data-target="#modalFile{{$asp->id_aspirasi}}" data-toggle="modal">File
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
                                                data-target="#modalUpdate{{$asp->id_aspirasi}}">Update
                                        </button>
                                        <button class="btn btn-outline-danger mb-2" data-toggle="modal"
                                                data-target="#modalDelete{{$asp->id_aspirasi}}">Delete
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
<div class="modal fade" id="modalUpdate{{$asp->id_aspirasi}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Status: <span class="badge badge-pill badge-secondary">{{$asp->status}}</span></h6>
                <hr>
                <form action="{{route('updateApirationStatus',$asp->id_aspirasi)}}" method="post">
                    @method('put')
                    @csrf
                    <input type="hidden" name="rowData" value="">
                    <input type="hidden" name="idAspirasi" value="">
                    <div class="form-group">
                        <label for="statusUpdate">Status Update</label>
                        <select name="statusUpdate" id="statusUpdate" class="update-selection btn btn-sm btn-outline-dark btn-block btn-lg">
                            <option value="{{$asp->status}}" selected disabled>
                                {{$asp->status}}
                            </option>
                            @if($asp->status == 'Belum Diproses')
                            <option value="Ditinjau">Ditinjau</option>
                            <option value="Sedang diprocess">Sedang diprocess</option>
                            <option value="Diteruskan">Diteruskan</option>
                            <option value="Done Resolved">Done Resolved</option>
                            @elseif($asp->status == 'Ditinjau')
                            <option value="Sedang diprocess">Sedang diprocess</option>
                            <option value="Diteruskan">Diteruskan</option>
                            <option value="Done Resolved">Done Resolved</option>
                            @elseif($asp->status == 'Sedang diprocess')
                            <option value="Diteruskan">Diteruskan</option>
                            <option value="Done Resolved">Done Resolved</option>
                            @else
                            <option value="Done Resolved">Done Resolved</option>
                            @endif
                        </select>
                    </div>
                    <hr>
                    @if($asp->status != 'Done Resolved')
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Update</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($asp->file_name))
<div aria-hidden="true" aria-labelledby="modalFile{{$asp->id_aspirasi}}" class="modal fade" id="modalFile{{$asp->id_aspirasi}}" role="dialog" tabindex="-1">
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
                foreach (json_decode($asp->file_name) as $file) { ?>
                    <a href="{{asset('files/'.$file)}}" target="_blank" class="btn btn-outline-info">Name: <?php echo $file ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
@endif
        <div class="modal fade" id="modalDelete{{$asp->id_aspirasi}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete Aspirasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Aspirasi akan dihapus. Anda yakin?
                    </div>
                    <form action="{{route('deleteAspiration',[$asp->id_aspirasi])}}" method="post">
                        @csrf
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

<div>
    @include('sweetalert::alert')
</div>
