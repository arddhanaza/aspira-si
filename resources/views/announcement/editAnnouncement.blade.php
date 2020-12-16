@extends('templates/template')

@include('templates.navbar')

@section('title','Aspiration')

@section('container')

    <section class="container  mt-5">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10 col-md-10 col-sm-12">
                <h5>
                    <button  onClick="window.history.back();" style="border: none;background-color: transparent;"><img
                            style="width: 30px;" src="{{asset('assets/icon/arrow-left-short.svg')}}" alt="">Back
                    </button>
                </h5>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12">
                <div class="card">
                    <form action="{{route('update_announcement',['id'=>$announcement->id_announcement])}}" method="post">
                        @method('put')
                        @csrf
                        <div class="card-header">
                            <h4>Edit Announcement</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id_announcement" value="{{$announcement->id_announcement}}">
                            <div class="form-group">
                                <label for="judul_aspirasi">Judul Aspirasi</label>
                                <select name="judul_aspirasi" id="judul_aspirasi" class="form-control">
                                    @foreach($aspirasi as $asp)
                                        <option value="{{$asp -> id_aspirasi}}">{{$asp -> judul_aspirasi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text_announcement">Announcement Text</label>
                                <textarea name="announcement_text" id="text_announcement" class="form-control" rows="10">{{$announcement->announcement_text}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">File Pendukung
                                    <label class="text-danger">*optional</label>
                                </label>
                                <input class="form-control-file" id="file" multiple type="file" name="file_name[]" value="{{ $announcement->nama_file }}">
                            </div>
                        </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--End of Aspiration Card-->
    </section>



    @if(session(0)->getTable() != 'bpm' or session(0)->getTable() != 'entitas_si')
        <script src="{{asset('assets/dist/js/vote.js')}}">
        </script>
    @endif

@endsection
