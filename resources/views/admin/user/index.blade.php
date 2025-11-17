@extends('layouts.admin.app')

@section('content')
    {{-- Start Main Content --}}


    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">User</a></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Data User</h1>
                <p class="mb-0">List data seluruh User</p>
            </div>
            <div>
                <a href="{{ route('user.create') }}" class="btn btn-success text-white">Tambah User</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="GET" action="{{ route('user.index') }}">
                            <div class="row align-items-end mb-3">

                                <!-- Filter Role -->
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Filter Role</label>
                                    <select name="role" onchange="this.form.submit()" class="form-select">
                                        <option value="">All Roles</option>
                                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff
                                        </option>
                                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User
                                        </option>
                                    </select>
                                </div>


                                <!-- Search Input -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Search</label>
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            value="{{ request('search') }}" placeholder="Search name, email...">

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
                        <table id="table-User" class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">Nama</th>
                                    <th class="border-0">Email</th>
                                    <th class="border-0">Role</th>
                                    <th class="border-0">Password</th>
                                    <th class="border-0 rounded-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataUser as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>

                                        <!-- Role Badge -->
                                        <td>
                                            <span
                                                class="badge
                        @if ($item->role == 'admin') bg-danger
                        @elseif($item->role == 'staff') bg-warning
                        @else bg-primary @endif">
                                                {{ ucfirst($item->role) }}
                                            </span>
                                        </td>

                                        <td>{{ $item->password }}</td>

                                        <td>
                                            <a href="{{ route('user.edit', $item->id) }}" class="btn btn-info btn-sm">
                                                <svg class="icon icon-xs me-2" fill="none" stroke-width="1.5"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                                Edit
                                            </a>

                                            <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin mau hapus user ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm">
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
                        {{ $dataUser->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection
