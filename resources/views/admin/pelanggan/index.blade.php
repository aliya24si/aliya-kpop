@extends('layouts.admin.app')

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Data Pelanggan</h1>
                <p class="mb-0">List data seluruh pelanggan</p>
            </div>
            <div>
                <a href="{{ route('pelanggan.create') }}" class="btn btn-success text-white">Tambah Pelanggan</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="GET" action="{{ route('pelanggan.index') }}">
                            <div class="row align-items-end mb-3">

                                <!-- Filter Gender -->
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Filter Gender</label>
                                    <select name="gender" onchange="this.form.submit()" class="form-select">
                                        <option value="">All Genders</option>
                                        <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>

                                <!-- Search Input -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Search</label>
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            value="{{ request('search') }}" placeholder="Search name, email, phone...">

                                        <button type="submit" class="btn btn-primary">
                                            <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>

                                        @if (request('search'))
                                            <a href="{{ route('pelanggan.index') }}"
                                                class="btn btn-outline-secondary">Clear</a>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </form>
                        <table id="table-pelanggan" class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">First Name</th>
                                    <th class="border-0">Last Name</th>
                                    <th class="border-0">Birthday</th>
                                    <th class="border-0">Gender</th>
                                    <th class="border-0">Email</th>
                                    <th class="border-0">Phone</th>
                                    <th class="border-0 rounded-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataPelanggan as $item)
                                    <tr>
                                        <td>{{ $item->first_name }}</td>
                                        <td>{{ $item->last_name }}</td>
                                        <td>{{ $item->birthday }}</td>
                                        <td>{{ $item->gender }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td class="d-flex gap-1">
                                            <!-- Tombol Detail (abu-abu) -->
                                            <a href="{{ route('pelanggan.show', $item) }}"
                                                class="btn btn-sm btn-secondary">
                                                Detail
                                            </a>

                                            <!-- Tombol Edit (biru) -->
                                            {{-- <a href="{{ route('pelanggan.edit', $item) }}" class="btn btn-sm btn-primary">
                                                Edit
                                            </a> --}}
                                            <a href="{{ route('pelanggan.edit', $item) }}" class="btn btn-sm btn-info text-white">
                                                {{-- Icon Edit SVG --}}
                                                <svg class="icon icon-xs me-2" fill="none" stroke-width="1.5"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>Edit</a>

                                            <!-- Tombol Hapus (merah) -->
                                            <form action="{{ route('pelanggan.destroy', $item) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 7h12M9 7V4h6v3m-1 4v6m-4-6v6M4 7h16l-1 13H5L4 7z" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $dataPelanggan->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
