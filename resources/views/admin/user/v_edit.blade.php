@extends('layouts.backend')

@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input 
                                    type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name"
                                    value="{{ old('name') ?? $user->name }}"
                                >
                                @error('name')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email"
                                    value="{{ old('email') ?? $user->email }}"
                                >
                                @error('email')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>                                        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password <span class="text-muted text-sm">(Kosongkan Jika Tidak Ingin Dirubah)</span>  </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @error('password')
                                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>                             
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password<span class="text-muted text-sm"> (Kosongkan Jika Tidak Ingin Dirubah)</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input 
                            type="file" 
                            class="form-control-file @error('photo') is-invalid @enderror" 
                            id="photo" 
                            name="photo"
                        >
                        @error('photo')
                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa fa-save mr-2"></i>
                        SIMPAN
                    </button>
                    <a href="{{ route('user.index') }}" class="btn btn-warning px-4 float-right">
                        CANCEL
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
