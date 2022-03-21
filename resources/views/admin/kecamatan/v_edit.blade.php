@extends('layouts.backend')

@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <form action="{{ route('kecamatan.update', $kecamatan->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <input 
                                    type="text" 
                                    class="form-control @error('kecamatan') is-invalid @enderror" 
                                    id="kecamatan" 
                                    name="kecamatan"
                                    value="{{ $kecamatan->kecamatan }}"
                                >
                                @error('kecamatan')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="warna">Warna</label>
                                <div class="input-group my-colorpicker2">
                                    <input 
                                        type="text" 
                                        class="form-control @error('warna') is-invalid @enderror" 
                                        id="warna" 
                                        name="warna"
                                        value="{{ $kecamatan->warna }}"
                                    >            
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                                    </div>
                                </div>
                                @error('warna')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="geojson">GeoJson</label>
                                <textarea name="geojson" id="geojson" rows="6" class="form-control @error('geojson') is-invalid @enderror" id="geojson" name="geojson">{{ $kecamatan->geojson }}</textarea>
                                @error('geojson')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fa fa-save mr-2"></i>
                        UPDATE
                    </button>
                    <button type="submit" class="btn btn-warning px-4 float-right">
                        CANCEL
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
@endpush

@push('script')
    <!-- Bootstrap Color Picker -->
    <script src="{{ asset('adminlte') }}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script>
        $('.my-colorpicker2').colorpicker()
        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });
    </script>
@endpush
