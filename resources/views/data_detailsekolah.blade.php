@extends('layouts.frontend')

@section('content')
   {{-- <?php dd($detailDataSekolah) ?>; --}}

   <div class="col-md-6">
        <div id="map" style="width: 100%; height: 400px;"></div>
    </div>

   <div class="col-md-6">
        <img src="{{ asset('foto') }}/{{ $detailDataSekolah->foto }}" alt="{{ $detailDataSekolah->nama }}" class="w-100" height="400px">
    </div>

    <div class="row mt-3 w-100">
        <div class="col">
            <table class="table table-bordered">
                <tr>
                    <td>Nama Sekolah</td>
                    <td>:</td>
                    <td>{{ $detailDataSekolah->nama }}</td>
                </tr>
                <tr>
                    <td>Jenjang</td>
                    <td>:</td>
                    <td>{{ $detailDataSekolah->jenjang->jenjang }}</td>
                </tr>
                <tr>
                    <td>kecamatan</td>
                    <td>:</td>
                    <td>{{ $detailDataSekolah->kecamatan->kecamatan }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $detailDataSekolah->alamat }}</td>
                </tr>
            </table>
        </div>
    </div>

<script>
    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11'
    });

    var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/satellite-v9'
    });

    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/dark-v10'
    });

    var map = L.map('map', {
        center: [{{ $detailDataSekolah->posisi }}],
        zoom: 15,
        layers: [peta3]
    });

    var baseMaps = {
        "Grayscale": peta1,
        "Satellite": peta2,
        "Streets": peta3,
        "Dark": peta4,
    };

    L.control.layers(baseMaps).addTo(map);

    var iconSekolah = L.icon({
        iconUrl: '{{ asset('icon') }}/{{ $detailDataSekolah->jenjang->icon }}',
        iconSize: [35, 40]
    });

    L.marker([<?= $detailDataSekolah->posisi ?>], {icon: iconSekolah})
        .addTo(map);
</script>
@endsection