@extends('template.layouts.master')

@section('content')
    <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Edit User</h2>
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
                    <form class="form-horizontal form-label-left" action="{{route('user.update',$user->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Nama</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name"  class="form-control" placeholder="Masukkan Nama" value="{{$user->name}}" required>
                            @if ($errors->has('name')) 
                                {!! \GeneralHelper::format_message($errors->first('name'),'danger')!!}
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">E-Mail</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" name="email"  class="form-control" placeholder="Masukkan E-Mail" value="{{$user->email}}" required>
                            @if ($errors->has('email')) 
                                {!! \GeneralHelper::format_message($errors->first('email'),'danger')!!}
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" name="password" class="form-control" placeholder="Masukkan Password Baru">
                          @if ($errors->has('password')) 
                                {!! \GeneralHelper::format_message($errors->first('password'),'danger')!!}
                            @endif
                            
                        </div>
                      </div>
                      
                      @if (Auth::user()->role->id == 1)
                          
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Level</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="role">
                            <option>-- Pilih Level User</option>
                            @foreach ($roles as $item)
                                @if ($user->role_id == $item->id)
                                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @else
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                          </select>
                          @if ($errors->has('role')) 
                                {!! \GeneralHelper::format_message($errors->first('role'),'danger')!!}
                            @endif
                        </div>
                      </div>
                      @else
                        <input type="hidden" name="role" value="{{$user->role_id}}">
                      @endif

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 ">
                            <a class="btn btn-danger" href="{{route('user')}}">Cancel</a>
                          
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