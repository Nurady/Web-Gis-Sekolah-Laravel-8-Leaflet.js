@extends('layouts.backend')

@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <form action="{{ route('jenjang.update', $jenjang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">                                          
                    <div class="form-group">
                        <label for="jenjang">Jenjang</label>
                        <input 
                            type="text" 
                            class="form-control @error('jenjang') is-invalid @enderror" 
                            id="jenjang" 
                            name="jenjang"
                            value="{{ $jenjang->jenjang }}"
                        >
                        @error('jenjang')
                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>                
                    <div class="form-group">
                        <label for="icon">Ganti Icon</label>
                        <input 
                            type="file" 
                            class="form-control" 
                            id="icon" 
                            name="icon"
                        >
                        <div class="mt-2">
                            <label class="mr-2">old Image</label>
                            <img src="{{ asset('icon') }}/{{ $jenjang->icon }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa fa-save mr-2"></i>
                        SIMPAN
                    </button>
                    <a href="{{ route('jenjang') }}" class="btn btn-warning px-4 float-right">
                        CANCEL
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
