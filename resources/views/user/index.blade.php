@extends('template.layouts.master')

@section('content')
<div class="right_col" role="main">
    <div class="">
      {{-- <div class="page-title">
        <div class="title_left">
          <h3>Users <small>Some examples to get you started</small></h3>
        </div>

        <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>
      </div> --}}

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Data User 
                @if (Auth::user()->role->id == 1)
                <a href="{{route('user.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Tambah User</a>
                
                @endif
            </h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <p class="text-muted font-13 m-b-30">
                Table ini menampilkan list - list data user yang ada pada system.
              </p>
              @if(session('message')) {!!session('message')!!} @endif
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Aksi</th>
                  </tr>
                </thead>


                <tbody>
                    @foreach ($data as $key=>$item )    
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{ucwords($item->name)}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->role->name}}</td>
                            <td>
                                <a href="{{route('user.show',$item->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Lihat"
                                class="editor_view"><i class="fa fa-expand"></i></a>
                                @if (Auth::user()->role->id == 1)    
                                    <a data-href="{{route('user.delete',$item->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm"
                                    title="Hapus" class="editor_remove"><i class="fa fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  {{-- modal delete --}}
  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus</h4>
            </div>
            <div class="modal-body">
              <p>Ingin Menghapus Data Ini ?</p>
            </div>
            <div class="modal-footer">
              <form action="" method="post" class="act-ok">
                <button type="button" class="btn btn-default inline" data-dismiss="modal">Batal</button>
                <input type="submit" name="submit" value="Hapus" class="btn btn-danger btn-ok"> {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('css')
    <link href="{{asset('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('js')
<script src="{{asset('assets/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.act-ok').attr('action', $(e.relatedTarget).data('href'));
      });
  
  </script>
@endsection