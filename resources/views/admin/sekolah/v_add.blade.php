@extends('layouts.backend')

@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <form action="{{ route('sekolah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body"> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
                                @error('nama')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>                                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select 
                                    class="form-control @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status"
                                >
                                    <option value="" readonly>-- Pilih Status Sekolah --</option>    
                                    <option value="Negeri">Negeri</option>
                                    <option value="Swasta">Swasta</option>
                                </select>
                                @error('status')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenjang_id">Jenjang</label>
                                <select 
                                    class="form-control @error('jenjang_id') is-invalid @enderror" 
                                    id="jenjang_id" 
                                    name="jenjang_id"
                                >
                                    <option value="" readonly>-- Pilih Jenjang Sekolah --</option>  
                                    @foreach ($jenjang as $item)
                                        <option value="{{ $item->id }}">{{ $item->jenjang }}</option>                                        
                                    @endforeach
                                </select>
                                @error('jenjang_id')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kecamatan_id">Kecamatan</label>
                                <select 
                                    class="form-control @error('kecamatan_id') is-invalid @enderror" 
                                    id="kecamatan_id" 
                                    name="kecamatan_id"
                                >
                                    <option value="" readonly>-- Pilih Kecamatan --</option> 
                                    @foreach ($kecamatan as $item)
                                        <option value="{{ $item->id }}">{{ $item->kecamatan }}</option>                                        
                                    @endforeach
                                </select>
                                @error('kecamatan_id')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>   
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat">
                        @error('alamat')
                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input 
                                    type="file" 
                                    class="form-control @error('foto') is-invalid @enderror" 
                                    id="foto" 
                                    name="foto"
                                >
                                @error('foto')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="posisi">
                                    Koordinat <span class="text-danger text-sm">(Input Manual atau Klik Map atau Drag/Drop Marker Map)</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control @error('posisi') is-invalid @enderror" 
                                    id="posisi" 
                                    name="posisi"
                                    {{-- readonly --}}
                                >
                                @error('posisi')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>Pilih Posisi Koordinat di Map</label>
                            <div id="map" style="width: 100%; height: 350px;"></div>
                        </div>                    
                    </div>        
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"></textarea>
                        @error('deskripsi')
                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa fa-save mr-2"></i>
                        SIMPAN
                    </button>
                    <a href="{{ route('sekolah') }}" class="btn btn-warning px-4 float-right">
                        CANCEL
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
@endpush

@push('script')
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
            zoom: 12,
            layers: [peta3]
        });

        var baseMaps = {
            "Grayscale": peta1,
            "Satellite": peta2,
            "Streets": peta3,
            "Dark": peta4,
        };

        L.control.layers(baseMaps).addTo(map);

        // Mengambil Titik Koordinat
        var curLocation = [-8.774166435742606,116.8545497604646];
        map.attributionControl.setPrefix(false)

        var marker = new L.marker(curLocation, {
            draggable : true,
        });

        map.addLayer(marker);

        // Ambil Koordinat Saat Marker di Drag dan Drop
        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                draggable : true,
            }).bindPopup(position).update();
            // console.log(position.lat + "," + position.lng);
            $("#posisi").val(position.lat + "," + position.lng).keyup();
        });

        // Ambil Koordinat Saat Peta di klik
        var posisi = document.querySelector("[name=posisi]");
        map.on('click', function(e) {
            var lat =  e.latlng.lat;
            var lng =  e.latlng.lng;

            if (!marker) {
                marker = L.marker(e.latlng).addTo(map);
            } else {
                marker.setLatLng(e.latlng);
            }

            posisi.value = lat + "," + lng
        });
    </script>
@endpush
