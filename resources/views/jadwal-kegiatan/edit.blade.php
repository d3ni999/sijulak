@extends('template.layouts.master')

@section('content')
    <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Edit Jadwal Kegiatan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    @if(session('message')) {!!session('message')!!} @endif
                    <form class="form-horizontal form-label-left" action="{{route('jadwal-kegiatan.update',$jadwal->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2 col-xs-12">Waktu</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class='input-group date' id='myDatepicker'>
                                  <input type='text' class="form-control" name="waktu" value="{{$jadwal->waktu}}"/>
                                  <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                              </div>
                              {{-- <input type="text" name="name"  class="form-control" placeholder="Masukkan Nama File" value="{{old('name')}}" required> --}}
                              @if ($errors->has('waktu')) 
                                  {!! \GeneralHelper::format_message($errors->first('waktu'),'danger')!!}
                              @endif
                          </div>
                        </div>
  
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2 col-xs-12">Kegiatan</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" name="kegiatan"  class="form-control" placeholder="Nama Kegiatan" value="{{$jadwal->kegiatan}}" required>
                              @if ($errors->has('kegiatan')) 
                                  {!! \GeneralHelper::format_message($errors->first('kegiatan'),'danger')!!}
                              @endif
                          </div>
                        </div>
  
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2 col-xs-12">Tempat</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" name="tempat_acara"  class="form-control" placeholder="Masukkan Tempat Acara" value="{{$jadwal->tempat_acara}}" required>
                              @if ($errors->has('tempat_acara')) 
                                  {!! \GeneralHelper::format_message($errors->first('tempat_acara'),'danger')!!}
                              @endif
                          </div>
                        </div>
  
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2 col-xs-12">Leading Sektor</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" name="leading_sektor"  class="form-control" placeholder="Masukkan Leading Sektor" value="{{$jadwal->leading_sektor}}" required>
                              @if ($errors->has('leading_sektor')) 
                                  {!! \GeneralHelper::format_message($errors->first('leading_sektor'),'danger')!!}
                              @endif
                          </div>
                        </div>
  
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2 col-xs-12">Pakaian</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" name="pakaian"  class="form-control" placeholder="Pakaian" value="{{$jadwal->pakaian}}" required>
                              @if ($errors->has('pakaian')) 
                                  {!! \GeneralHelper::format_message($errors->first('pakaian'),'danger')!!}
                              @endif
                          </div>
                        </div>
  
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2 col-xs-12">Keterangan</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <textarea name="keterangan" class="form-control" placeholder="Masukkan Keterangan" id="keterangan" cols="30" rows="10" required>{{$jadwal->keterangan}}</textarea>
                              @if ($errors->has('keterangan')) 
                                  {!! \GeneralHelper::format_message($errors->first('keterangan'),'danger')!!}
                              @endif
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2 col-xs-12">Pilih Opd</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            @foreach ($userOpd as $item)    

                              @if(in_array($item->id, $jadwal->getDetails->pluck('user_id')->toArray()))
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" value="{{$item->id}}" class="flat" name="opd[]" checked> {{ucwords($item->name)}}
                                  </label>
                                </div>
                              @else
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" value="{{$item->id}}" class="flat" name="opd[]"> {{ucwords($item->name)}}
                                </label>
                              </div>
                              @endif
                            @endforeach
                              {{-- <div class="checkbox">
                                <label>
                                  <input type="checkbox" class="flat" name="opd[]"> Unchecked
                                </label>
                              </div> --}}
                              @if ($errors->has('opd')) 
                                  {!! \GeneralHelper::format_message($errors->first('opd'),'danger')!!}
                              @endif
                          </div>
                        </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 ">
                            <a class="btn btn-danger" href="{{route('jadwal-kegiatan')}}">Cancel</a>
                          
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
@section('css')
    <!-- Switchery -->
    <link href="{{asset('assets/vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="{{asset('assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
@endsection

@section('js')
    <!-- bootstrap-progressbar -->
    <script src="{{asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('assets/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- jQuery Tags Input -->
    <script src="{{asset('assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
    <!-- Switchery -->
    <script src="{{asset('assets/vendors/switchery/dist/switchery.min.js')}}"></script>

      <!-- bootstrap-daterangepicker -->
  <script src="{{asset('assets/vendors/moment/min/moment.min.js')}}"></script>
  <script src="{{asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
  <!-- bootstrap-datetimepicker -->    
  <script src="{{asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
  <script type="text/javascript">
    
    $('#myDatepicker').datetimepicker();
  </script>
    
@endsection