@extends('template.layouts.master')

@section('content')
    <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Edit File Undangan</h2>
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
                    <form class="form-horizontal form-label-left" action="{{route('file-undangan.update',$file->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Nama</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name"  class="form-control" placeholder="Masukkan Nama" value="{{$file->name}}" required>
                            @if ($errors->has('name')) 
                                {!! \GeneralHelper::format_message($errors->first('name'),'danger')!!}
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">File</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="file" accept=".doc,.docx,application/msword,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document" class="form-control" placeholder="Masukkan File">
                            <small>maximal file 5MB</small><br>
                            <small>file sekrangan: <a href="{{asset('assets/file-undangan/'.$file->file)}}" target="_blank">{{$file->file}}</a></small>
                            @if ($errors->has('file')) 
                            {{-- @dd($errors->get('file')); --}}
                                @foreach ($errors->get('file') as $item)  
                                  {!! \GeneralHelper::format_message($item,'danger')!!}
                                @endforeach
                            @endif
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 ">
                            <a class="btn btn-danger" href="{{route('file-undangan')}}">Cancel</a>
                          
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
    
@endsection