@extends('layouts.master')

@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/datatables-bs/css/datatables.bootstrap.min.css')}}">
<style>
  .single-row{
    cursor: pointer;
  }
</style>
@endsection

@section('content')

<section class="content-header">
      <h1>
        View Playlist Data
        
      </h1>
      {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> --}}
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
         <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                    
                    <div class="box">
                        <div class="box-header">
                        <h3 class="box-title">Available User</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                            <th>ID</th>
                            <th>Music Name</th>
                            <th>Artist Name</th>
                            <th>Language</th>
                            <th>Play Count</th>
                            <th>First Play</th>
                            <th>Date Last Payed</th>
                            <th>Date Added</th>
                            
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($musics as $music)
                                <tr>
                                    <td>{{$music->id}}</td>
                                    <td>{{$music->name}}</td>
                                    <td>{{$music->artist}}</td>
                                    <td>{{$music->language}}</td>
                                    <td>{{$music->play_count}}</td>
                                    <td>{{$music->first_play}}</td>
                                    <td>{{$music->last_play}}</td>
                                    <td>{{$music->first_seen}}</td>
                                </tr>
                            @endforeach
                        
                            </tbody>
                        </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    
                    </div>
                    <!-- /.col -->
                </div>
      <!-- /.row -->
    </section>
    </section>
    



    @endsection


@section('scripts')

<script src="{{asset('bower_components/datatables/js/jquery.datatables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables-bs/js/datatables.bootstrap.min.js')}}"></script>

<script>
  $(function () {
    // $('#example2').DataTable({
    //   'paging'      : true,
    //   'lengthChange': false,
    //   'searching'   : false,
    //   'ordering'    : true,
    //   'info'        : true,
    //   'autoWidth'   : true
    // })

    $('#example1').DataTable({
      'autoWidth': true
    })

    
  })
</script>
{{-- <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> --}}
{{-- <script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> --}}
{{-- <script src="/bower_components/fastclick/lib/fastclick.js"></script> --}}
{{-- <script src="/js/adminlte.min.js"></script> --}}

@endsection