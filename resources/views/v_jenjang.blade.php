@extends('layouts.frontend')

@section('content')
<div id="map" style="width: 100%; height: 700px;"></div>

<div class="mt-3 col-sm-12 mb-4">
    <hr>
    <h4 class="text-center"><b>Data Sekolah {{ $title }}</b></h4>
    <table id="example1" class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th style="width: 8%;" class="text-center">No.</th>
                <th class="text-center">Sekolah</th>
                <th class="text-center">Jenjang</th>
                <th class="text-center">Status</th>
                <th class="text-center">Koordinat</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sekolah as $key=>$item)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">{{ $item->nama }}</td>
                    <td class="text-center">{{ $item->jenjang }}</td>
                    <td class="text-center">{{ $item->status }}</td>
                    <td class="text-center">{{ $item->posisi }}</td>
                    <td>
                        <a href="detailsekolah/{{ $item->id }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum Ada Data Sekolah</td>
                </tr>
            @endforelse              
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

    @foreach($sekolah as $data)    
        var iconSekolah = L.icon({
            iconUrl: '{{ asset('icon') }}/{{ $data->icon }}',
            iconSize: [35, 40]
        });

        var informasi = '<table class="table table-bordered"><tr><th colspan="2"><img src="{{ asset('foto') }}/{{ $data->foto ?? ''}}" width="200px" height="200px"></th></tr><tbody><tr><td>Nama Sekolah</td><td>{{ $data->nama ?? ''}}</td></tr><tr><td>Jenjang</td><td>{{ $data->jenjang }}</td></tr><tr><td>Status</td><td>{{ $data->status ?? ''}}</td></tr><tr><td colspan="2" class="text-center"><a href="/detailsekolah/{{ $data->id }}" class="btn btn-sm btn-primary text-white px-4">Detail</a></td></tr></tbody></table>';
        
        L.marker([{{ $data->posisi ?? ''}}], {icon: iconSekolah})
            .addTo(map)
            .bindPopup(informasi);
    @endforeach
</script>
@endsection