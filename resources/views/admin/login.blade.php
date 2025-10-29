<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - Pembangunan & Monitoring Proyek</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Volt Assets -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/volt.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <main>
        <section class="vh-100 d-flex align-items-center justify-content-center bg-light">
            <div class="container">
                <div class="row justify-content-center align-items-center">

                    <!-- Kolom kiri: Gambar -->
                    <div class="col-lg-6 text-center d-none d-lg-block">
                        <img src="{{ asset('assets-admin/img/icon-pembangunan.png') }}" alt="Ilustrasi Pembangunan"
                            class="img-fluid" style="max-height: 400px;">
                        <h3 class="fw-bold text-primary mt-4">Dashboard Login</h3>
                        <p class="text-muted">Halaman Template Login Volt</p>
                    </div>

                    <!-- Kolom kanan: Form Login -->
                    <div class="col-lg-5 col-md-8">
                        <div class="card shadow border-0">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <h4 class="fw-bold text-dark">Masuk ke Sistem</h4>
                                    <p class="text-muted mb-0">Gunakan akun yang terdaftar di sistem</p>
                                </div>

                                {{-- Alert Message --}}
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <form action="{{ route('login.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Masukkan email" value="{{ old('email') }}" required>
                                        </div>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Masukkan password" required>
                                        </div>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary fw-semibold">Masuk</button>
                                    </div>
                                </form>

                                <div class="text-center mt-4">
                                    <small class="text-muted">
                                        © {{ date('Y') }} Muhammad Raja Muiz
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="{{ asset('assets-admin/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
