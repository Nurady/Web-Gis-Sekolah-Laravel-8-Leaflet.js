<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>GIS Sekolah KSB | {{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @stack('style')

    <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="{{ route('homepage') }}" class="navbar-brand">
            <img src="{{ asset('adminlte') }}/dist/img/128.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">
                <b>GIS Sekolah KSB</b>       
            </span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <ul class="navbar-nav">
              <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                  <a href="{{ route('homepage') }}" class="nav-link">Home</a>
              </li>          
              {{-- <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
                  class="nav-link dropdown-toggle {{ Request::segment(1) === 'kecamatan' ? 'active' : null }}">
                    Kecamatan
                  </a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                      @foreach ($kecamatan as $data)
                          <li>
                              <a href="/kecamatan/{{ $data->id }}" class="dropdown-item {{ request()->is('kecamatan/'.$data->id) ? 'active' : '' }}">
                                  {{ $data->kecamatan }}
                              </a>
                          </li>                         
                      @endforeach
                  </ul>
              </li> --}}
              <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
                class="nav-link dropdown-toggle {{ Request::segment(1) === 'kecamatan' ? 'active' : null }}">
                  Data Kecamatan
                </a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    @foreach ($kecamatan as $data)
                        <li>
                            <a href="{{ route('data_kecamatan', $data->id) }}" class="dropdown-item {{ request()->is('kecamatan/'.$data->id) ? 'active' : '' }}">
                                {{ $data->kecamatan }}
                            </a>
                        </li>                         
                    @endforeach
                </ul>
              </li>
              {{-- <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                    Jenjang
                  </a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                      @foreach ($jenjang as $data)
                        <li><a href="/jenjang/{{ $data->id }}" class="dropdown-item">{{ $data->jenjang }}</a></li>                       
                      @endforeach
                  </ul>
              </li> --}}
              <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                  Data Jenjang
                </a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    @foreach ($allJenjang as $data)
                        <li><a href="{{ route('data_jenjang', $data->id) }}" class="dropdown-item">{{ $data->jenjang }}</a></li>                       
                    @endforeach
                </ul>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link">About</a>
              </li>
          </ul>
      </div>

      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                  {{-- <i class="fas fa-user mr-1"></i> --}}
                  @svg('ri-login-circle-line')
                  LOGIN
                </a>
            </li>
      </ul>
    </div>
  </nav>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><small>{{ $title }}</small></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </div>
  </div>

  <footer class="main-footer">
      <div class="float-right d-none d-sm-inline">
        <strong><a href="https://adminlte.io/" class="mr-1">AdminLTE.io</a></strong>Theme
      </div>
      <strong>Copyright &copy; <a href="#" class="mr-1">PT. Creative Solution</a></strong>All rights reserved
  </footer>
</div>
@stack('script')
</body>
</html>
