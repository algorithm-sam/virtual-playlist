@extends('layouts.master')


@section('content')
    <section class="content-header">
        <h1>
          Import Playlist
        </h1>
    </section>

    <section class="content container-fluid">
        <section class="content">
                <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-info">
                   <div class="box-header with-border">
                     <h3 class="box-title">Add Playlist Information From XML File</h3>
                   </div>
                   <!-- /.box-header -->
                   <!-- form start -->
                 <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{route('upload-playlist')}}">
                       @csrf
                       <div class="box-body">
                         <div class="form-group">
                           <label for="name" class="col-sm-2 control-label">Select XML File</label>
                           <div class="col-sm-10">
                             <div>
                           <input type="file" name="file" class="form-control" id="name">
                           </div>
                           @error('file')
                             <div class="text-danger">
                               {{$message}}
                             </div>
                             @enderror
                           </div>
                         </div>
                     
       
                     </div>
                     <!-- /.box-body -->
                     <div class="box-footer">
                       <button type="submit" class="btn btn-info">Upload</button>
                     </div>
                     <!-- /.box-footer -->
                   </form>
                 </div>
                        </div>
                    </div>
        </section>
    </section>

@endsection


@section('scripts')

@endsection

@section('styles')

@endsection