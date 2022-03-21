@extends('layouts.backend')

@section('content')
<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3>{{ $totalKecamatan }}</h3>
            <p>Kecamatan</p>
        </div>
        <div class="icon">
            <i class="fas fa-cloud"></i>
        </div>
        <a href="{{ route('kecamatan') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">    
    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{ $totalJenjang }}</h3>
        <p>Jenjang</p>
    </div>
        <div class="icon">
            <i class="nav-icon fas fa-graduation-cap"></i>
        </div>
        <a href="{{ route('jenjang') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
        <div class="inner">
            <h3>{{ $totalSekolah }}</h3>
            <p>Sekolah</p>
        </div>
        <div class="icon">
            <i class="nav-icon fas fa-university"></i>
        </div>
        <a href="{{ route('sekolah') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
        <div class="inner">
            <h3>{{ $totalUser }}</h3>
            <p>Users</p>
        </div>
        <div class="icon">
            <i class="nav-icon fas fa-users"></i>
        </div>
        <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
@endsection
