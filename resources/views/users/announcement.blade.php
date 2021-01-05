@extends('templates/template')

@include('templates.navbar')

@section('title','Announcement')

@section('container')

    <section class="mt-5 container-fluid">
        <!--Start of Aspiration Card-->
        <div class="row justify-content-center mb-4">
            <div class="col-10">
                <div class="card aspiration-card-table">
                    <div class="card-body table-responsive">
                        <table class="table table-striped datTable">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Annoucement</th>
                                <th>File Pendukung</th>
                                {{--                                <th>Nama File</th>--}}
                                <th>Issue Terkait</th>
                                <th>Tanggal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($announcements as $anc)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$anc->announcement_text}}</td>
                                    <td>
                                        @if(isset($asp->file_name))
                                            <a href="" class="btn btn-outline-info"
                                               data-target="#modalFile{{$asp->id_aspirasi}}" data-toggle="modal">File
                                                Pendukung</a>
                                        @else
                                            <span>Tidak Ada File Pendukung</span>
                                        @endif
                                    </td>
                                    @if($anc->judul_aspirasi == 'Tanpa Tujuan')
                                        <td>{{$anc->judul_aspirasi}}</td>
                                    @else
                                        <td><a href="{{route('detailAspiration',[$anc->id_aspirasi])}}">{{$anc->judul_aspirasi}}</a></td>
                                    @endif
                                    <td>{{$anc->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


