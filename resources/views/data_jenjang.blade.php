@extends('layouts.frontend')

@section('content')
@if(count($jenjangRow->sekolahs) > 0)
    <div id="map" style="width: 100%; height: 600px;"></div>
@endif

<div class="mt-3 col-sm-12 mb-4">
    <h4 class="text-center"><b>Tabel Data Sekolah {{ $title }}</b></h4>
    <table id="example1" class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th style="width: 8%;" class="text-center">No.</th>
                <th class="text-center">Sekolah</th>
                <th class="text-center">Status</th>
                <th class="text-center">Koordinat</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if(count($jenjangRow->sekolahs) > 0)
                @foreach ($jenjangRow->sekolahs as $key=>$item)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td class="text-center">{{ $item->nama }}</td>
                        <td class="text-center">{{ $item->status }}</td>
                        <td class="text-center">{{ $item->posisi }}</td>
                        <td class="text-center">
                            <a href="{{ route('data_jenjang_detailsekolah', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="5" class="text-center">Belum Ada Data Sekolah</td>
                </tr>
            @endif
        </tbody>
    </table>
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
        center: [-8.802836526778522, 116.92573466592643],
        zoom: 10,
        layers: [peta2]
    });

    var baseMaps = {
        "Grayscale": peta1,
        "Satellite": peta2,
        "Streets": peta3,
        "Dark": peta4,
    };

    L.control.layers(baseMaps).addTo(map);

    @foreach($kecamatan as $data)
        L.geoJSON(<?= $data->geojson ?>, {
            style : {
                color : 'white', 
                fillColor: '{{ $data->warna }}',
                fillOpacity: 0.7
            }
        }).addTo(map);
    @endforeach

    @foreach($jenjangRow->sekolahs as $data)    
        var iconSekolah = L.icon({
            iconUrl: '{{ asset('icon') }}/{{ $data->jenjang->icon }}',
            iconSize: [35, 40]
        });

        var informasi = '<table class="table table-bordered"><tr><th colspan="2"><img src="{{ asset('foto') }}/{{ $data->foto ?? ''}}" width="200px" height="200px"></th></tr><tbody><tr><td>Nama Sekolah</td><td>{{ $data->nama ?? ''}}</td></tr><tr><td>Jenjang</td><td>{{ $data->jenjang->jenjang }}</td></tr><tr><td>Status</td><td>{{ $data->status ?? ''}}</td></tr><tr><td colspan="2" class="text-center"><a href="/data/jenjang/{{ $data->id }}/detailsekolah" class="btn btn-sm btn-primary text-white px-4">Detail</a></td></tr></tbody></table>';
        
        L.marker([{{ $data->posisi ?? ''}}], {icon: iconSekolah})
            .addTo(map)
            .bindPopup(informasi);
    @endforeach
</script>

@endsection