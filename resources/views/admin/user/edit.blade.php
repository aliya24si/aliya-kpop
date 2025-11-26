@extends('layouts.admin.app')

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10
                                        a1 1 0 001 1h3m10-11l2 2m-2-2v10
                                        a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4
                                        a1 1 0 011-1h2a1 1 0 011 1v4
                                        a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Edit User</h1>
                <p class="mb-0">Form untuk memperbarui data User</p>
            </div>
            <div>
                <a href="{{ route('user.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Form Edit Data User</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-info">
                            {!! session('success') !!}
                        </div>
                    @endif

                    <form action="{{ route('user.update', $dataUser->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ $dataUser->name }}" maxlength="100" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-4 col-md-12 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ $dataUser->email }}" maxlength="255" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role"
                                required>
                                <option value="admin" {{ $dataUser->role == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="staff" {{ $dataUser->role == 'staff' ? 'selected' : '' }}>Staff
                                </option>
                                <option value="user" {{ $dataUser->role == 'user' ? 'selected' : '' }}>User
                                </option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Isi jika ingin ubah password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-4 col-md-12 mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="photo" class="form-label">Foto Profil</label>

                            @if ($dataUser->photo)
                                <img src="{{ asset('storage/photo/' . $dataUser->photo) }}" width="80" height="80"
                                    class="rounded-circle mb-2 object-fit-cover">
                            @endif

                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>

                        <hr class="mt-0">

                        <div class="text-end">
                            <button type="submit" class="btn btn-info text-white me-2">Simpan Perubahan</button>
                            <a href="{{ route('user.index') }}" class="btn btn-outline-dark">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
