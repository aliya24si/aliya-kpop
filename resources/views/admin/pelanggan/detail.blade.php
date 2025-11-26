@extends('layouts.admin.app')

@section('content')
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Detail Pelanggan</h3>

            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary"> Kembali
            </a>
        </div>

        <hr>

        <h5 class="mb-3"><strong>Files By</strong> {{ $pelanggan->first_name }} {{ $pelanggan->last_name }}</h5>

        <div class="row">
            @forelse ($files as $file)
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm">

                        {{-- Thumbnail Foto --}}
                        <a href="{{ asset('uploads/' . $file->filename) }}" target="_blank">
                            <img src="{{ asset('uploads/' . $file->filename) }}" class="card-img-top"
                                style="height: 180px; object-fit: cover; border-radius: 5px;">
                        </a>

                        <div class="card-body text-center">

                            {{-- Nama file --}}
                            <p class="small text-muted"
                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $file->filename }}
                            </p>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('pelanggan.file.delete', $file->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus file ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm w-100">Hapus</button>
                            </form>

                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Belum ada file</p>
            @endforelse
        </div>

    </div>
@endsection
