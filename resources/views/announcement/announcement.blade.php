@extends('templates/template')

@include('templates.navbar')

@section('title','Announcement')


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
                                <th>Oleh</th>
                                <th>Judul Aspirasi</th>
                                <th>Announcement</th>
{{--                                <th>Nama File</th>--}}
                                <th>Created At</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($announcements as $anc)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$anc->nama_entitas}}</td>
                                    <td>{{$anc->judul_aspirasi}}</td>
                                    <td>{{$anc->announcement_text}}</td>
{{--                                    <td>--}}
{{--                                        @if(isset($asp->nama_file))--}}
{{--                                            <a href="" class="btn btn-outline-info"--}}
{{--                                               data-target="#modalFile" data-toggle="modal">File--}}
{{--                                                Pendukung</a>--}}
{{--                                        @else--}}
{{--                                            <span>Tidak Ada File Pendukung</span>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
                                    <td>{{$anc->created_at}}</td>
                                    <td>
                                        <a href="{{route('edit_announcement',$anc->id_announcement)}}" class="btn btn-primary mb-2">Edit</a>
                                        <a href="{{route('delete_announcement',['id'=>$anc->id_announcement])}}" class="btn btn-outline-danger mb-2">Delete</a>
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

    @if(session('0')->getTable() != 'mahasiswa')
        <button class="btn btn-primary feb btn-lg rounded-circle" data-target="#exampleModalCenter" data-toggle="modal">
            +
        </button>

        <div aria-hidden="true" aria-labelledby="exampleModalCenterTitle" class="modal fade" id="exampleModalCenter"
             role="dialog" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Announcement</h5>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('post_announcement')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id_entitas" value="{{session(0)->id_entitas}}">                            
                            <label for="judul_aspirasi">Judul Aspirasi</label>
                            <select name="judul_aspirasi" id="judul_aspirasi" class="form-control">
                                <option value="">Tanpa Tujuan</option>
                                @foreach($aspirasi as $asp)
                                    <option value="{{$asp -> id_aspirasi}}">{{$asp -> judul_aspirasi}}</option>
                                @endforeach
                            </select>
                            <label for="textAnnouncement">Teks Announcement</label>
                            <textarea class="form-control" name="announcement_text" id="textAnnouncement" cols="30" rows="10"
                                      required></textarea>
                            <label for="file">File Pendukung
                                <label class="text-danger">*optional</label>
                            </label>
                            <input class="form-control-file" id="file" multiple type="file" name="file_name[]">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                            <button class="btn btn-primary" type="submit">Post Announcement</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endif
@endsection
