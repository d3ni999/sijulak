@extends('template.layouts.master')

@section('content')
<div class="right_col" role="main" style="background-image:url({{asset('assets/images/login.jpeg')}});background-repeat: no-repeat; background-size: cover;">
    <!-- top tiles -->
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-clock-o"></i></div>
            <div class="count">{{$hari_ini->count()}}</div>
            <h3>Hari Ini</h3>
            <p>Total jadwal hari ini.</p>
          </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-table"></i></div>
            <div class="count">{{\GeneralHelper::countRawTable('jadwal_kegiatans')}}</div>
            <h3>Jadwal Kegiatan</h3>
            <p>Total Jadwal Kegiatan pada system.</p>
          </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-file"></i></div>
            <div class="count">{{\GeneralHelper::countRawTable('file_undangans')}}</div>
            <h3>File Undangan</h3>
            <p>Total File Undangan.</p>
          </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-user"></i></div>
            <div class="count">{{\GeneralHelper::countRawTable('users')}}</div>
            <h3>Users</h3>
            <p>Total User pada system.</p>
          </div>
        </div>
      </div>
    <!-- /top tiles -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">



        <div class="row">

            <div class="col-md-12">
                <img class="img img-responsive" src="{{asset('assets/images/welcome.png')}}" alt="" style="width: 100%;">
              </div>
          </div>
      </div>
      {{-- 5 jadwal hari ini --}}
      <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 10px;">
        <div class="x_panel">
          <div class="x_title">
            <h2>Jadwal <strong>Hari Ini</strong> {{date('d M Y')}}</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="dashboard-widget-content">

              <ul class="list-unstyled timeline widget">
                @foreach ($hari_ini as $item)
                <li>
                  <div class="block">
                      <div class="block_content">
                        <h2 class="title">
                          <a>{{ucwords($item->kegiatan)}}</a>
                        </h2>
                        <div class="byline">
                          <span>{!! \GeneralHelper::nama_hari(date('D, d M Y h:i',strtotime($item->waktu))) !!}</span> by <a>Admin</a>
                        </div>
                        <p class="excerpt">
                            {{$item->keterangan}}
                        </p>
                      </div>
                    </div>
                  </li>
                @endforeach   
              </ul>
            </div>
          </div>
        </div>
      </div>
      {{-- 5 jadwal terdekat --}}
      <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 10px;">
        <div class="x_panel">
          <div class="x_title">
            <h2>Jadwal <strong>Besok</strong> {{date("d M Y", time() + 86400)}}</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="dashboard-widget-content">

              <ul class="list-unstyled timeline widget">
                  @foreach ($besok_hari as $item)
                  <li>
                    <div class="block">
                        <div class="block_content">
                          <h2 class="title">
                            <a>{{ucwords($item->kegiatan)}}</a>
                          </h2>
                          <div class="byline">
                            <span>{!! \GeneralHelper::nama_hari(date('D, d M Y h:i',strtotime($item->waktu))) !!}</span> by <a>Admin</a>
                          </div>
                          <p class="excerpt">
                              {{$item->keterangan}}
                          </p>
                        </div>
                      </div>
                    </li>
                  @endforeach   
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

