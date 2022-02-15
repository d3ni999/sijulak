@extends('template.layouts.master')

@section('content')
<div class="right_col" role="main">
    <div class="">
      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Data Jadwal Kegiatan 
                @if (Auth::user()->role->id == 1)
                <br class="visible-xs">
                <a href="{{route('jadwal-kegiatan.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Tambah Jadwal Kegiatan</a>  
                @endif
            </h2>
              
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="navbar-right">
              <form class="form-inline">
                <div class="form-group">
                  <div class="controls">
                    <div class="input-prepend input-group">
                      <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                        <input type="text" style="" name="filter" id="filter" class="form-control" value="{{now()}}" />
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-secondary"><i class="fa fa-search"></i> Filter</button>
              </form>
            </div>
              <p class="text-muted font-13 m-b-30">
                Table ini menampilkan list - list data jadwal kegiatan yang ada pada system.
              </p>

              @if(session('message')) {!!session('message')!!} @endif
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Waktu</th>
                    <th>Kegiatan</th>
                    <th>Tempat</th>
                    <th>Leading Sektor</th>
                    <th>Pakaian</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>


                <tbody>
                    @foreach ($data as $key=>$item )    
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{!! \GeneralHelper::nama_hari(date('D, d M Y H:i',strtotime($item->waktu))) !!}</td>
                            <td>{{$item->kegiatan}}</td>
                            <td>{{$item->tempat_acara}}</td>
                            <td>{{$item->leading_sektor}}</td>
                            <td>{{$item->pakaian}}</td>
                            <td>{{$item->keterangan}}</td>
                            
                            <td>
                                <a href="{{route('jadwal-kegiatan.show',$item->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Lihat/ Absen"
                                    class="editor_view"><i class="fa fa-expand"></i></a>
                                @if (Auth::user()->role->id == 1)    
                                <a href="{{route('jadwal-kegiatan.edit',$item->id)}}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Edit"
                                class="editor_view"><i class="fa fa-pencil"></i></a>
                                <a data-href="{{route('jadwal-kegiatan.delete',$item->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm"
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
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="{{asset('assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
@endsection

@section('js')
<script src="{{asset('assets/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{asset('assets/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap-datetimepicker -->    
<script src="{{asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>

<script type="text/javascript">
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.act-ok').attr('action', $(e.relatedTarget).data('href'));
      });

    $('#filter').daterangepicker(null, function(start, end, label) {
      console.log(start.toISOString(), end.toISOString(), label);
    });

    $('#filter-time').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
      format: 'MM/DD/YYYY h:mm A'
      }
    });
  
  </script>
@endsection