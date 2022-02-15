@extends('template.layouts.master')

@section('content')
<div class="right_col" role="main">
    <div class="">
      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Detail Jadwal Kegiatan 
            </h2>
              
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              
                <div class="row">
                    <div class="col-md-6">
                        <label>Waktu</label>
                        <p class="red">{!! \GeneralHelper::nama_hari(date('D, d M Y H:i',strtotime($jadwal->waktu))) !!}</p>
                        <label>kegiatan</label>
                        <p>{{$jadwal->kegiatan}}</p>
                        <label>Tempat</label>
                        <p>{{$jadwal->tempat_acara}}</p>
                    </div>
                    <div class="col-md-6">
                        <label>Leading Sektor</label>
                        <p>{{$jadwal->leading_sektor}}</p>
                        <label>Pakaian</label>
                        <p>{{$jadwal->pakaian}}</p>
                        <label>Keterangan</label>
                        <p>{{$jadwal->keterangan}}</p>
                    </div>
                  </div>                

              @if(session('message')) {!!session('message')!!} @endif
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Absen</th>
                    <th>Keterangan</th>
                    @if (Auth::user()->role->id == 1)    
                    <th>Aksi</th>
                    @endif
                  </tr>
                </thead>


                <tbody>
                    @foreach ($jadwal->getDetails as $key=>$item )    
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$item->getAudience->name}}</td>
                            <td>

                              @php
                                  $absen = ['hadir','tidak hadir','belum absen'];
                              @endphp
                              <select class="form-control select-absen">
                                @foreach ($absen as $value)

                                  <option value="{{$value}}" data-href="{{route('jadwal-kegiatan.changeStatus',$item->id)}}" {{($item->absen==$value) ? 'selected':''}}>{{$value}}</option>       
                                @endforeach
                              </select>
                            </td>
                            <td>{{$item->keterangan}}</td>
                            @if (Auth::user()->role->id == 1)    
                            <td>
                                {{-- <a href="{{route('jadwal-kegiatan.show',$item->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Absen"
                                    class="editor_view"><i class="fa fa-check"></i></a> --}}
                                <a data-href="{{route('jadwal-kegiatan.detail.delete',$item->id)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm"
                                title="Hapus" class="editor_remove"><i class="fa fa-trash"></i></a>
                            </td>
                            @endif
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
  {{-- modal change --}}
  <div class="modal fade" id="change-status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="post" class="act-status">
          <div class="modal-header">
            <h4 class="modal-title">Update Status</h4>
          </div>
          <div class="modal-body">
            <p>Ingin Mengupdate Data Ini ?</p>
            <input type="hidden" value="" name="absen" id="absenText">
            <textarea class="form-control" name="keterangan" id="keteranganText" placeholder="Catatan Tambahan" cols="30" rows="5"></textarea>
          </div>
          <div class="modal-footer">
              <button type="button" onClick="window.location.reload()" class="btn btn-default inline" data-dismiss="modal">Batal</button>
              <input type="submit" name="submit" value="Update" class="btn btn-warning btn-ok"> {{ csrf_field() }}
              <input type="hidden" name="_method" value="PUT">
          </div>
        </form>
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

    $('.select-absen').change(function(){
      //this is just getting the value that is selected
      let status = $(this).val();
      // $('.modal-title').html(title);
      let link = $(this).find(':selected').data('href')

      // form set
      $('.act-status').attr('action', link);
      $('.act-status #absenText').val(status);
      
      $('#change-status').modal('show');
    });
  
  </script>
@endsection