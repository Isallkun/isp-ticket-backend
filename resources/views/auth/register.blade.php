@extends('layouts.auth')
@section('title', 'Register')

@section('content')
<style>
    .register-page {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
    }

    .register-page::before {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: moveGrid 20s linear infinite;
        opacity: 0.5;
    }

    @keyframes moveGrid {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
    }

    .register-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out;
        backdrop-filter: blur(10px);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card-header.gradient-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 1rem 1.5rem;
        position: relative;
    }

    .card-header.gradient-header::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 0;
        right: 0;
        height: 30px;
        background: white;
        border-radius: 50% 50% 0 0 / 100% 100% 0 0;
    }

    .logo-circle {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
        border: 3px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
    }

    .logo-circle i {
        font-size: 1rem;
        color: white;
    }

    .card-header h3 {
        font-weight: 700;
        font-size: 1.1rem;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .card-header p {
        opacity: 0.95;
        font-size: 0.75rem;
        margin-bottom: 0;
    }

    .card-body.enhanced {
        padding: 1.5rem 1.5rem 1rem;
    }

    .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .form-label i {
        margin-right: 0.5rem;
        color: #667eea;
    }

    .form-control.modern {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .form-control.modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.1);
        background: white;
    }

    .form-control.modern.is-invalid {
        border-color: #dc3545;
        background: #fff5f5;
    }

    .form-control.modern.is-invalid:focus {
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.1);
    }

    .form-select.modern {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .form-select.modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.1);
        background: white;
    }

    .form-check-input {
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid #cbd5e0;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }

    .form-check-label {
        color: #4a5568;
        font-size: 0.9rem;
        cursor: pointer;
        user-select: none;
        margin-left: 0.5rem;
    }

    .btn.btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 0.875rem 1.5rem;
        font-size: 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn.btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(102, 126, 234, 0.5);
    }

    .btn.btn-gradient:active {
        transform: translateY(0);
    }

    .btn.btn-gradient i {
        margin-right: 0.5rem;
    }

    .register-section {
        border-top: 1px solid #e2e8f0;
        padding-top: 1.5rem;
        margin-top: 1rem;
    }

    .register-section small {
        color: #64748b;
        font-size: 0.9rem;
    }

    .register-section a {
        color: #667eea;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .register-section a:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .alert.modern {
        border-radius: 12px;
        border: none;
        padding: 1rem 1.25rem;
        animation: slideDown 0.4s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-danger.modern {
        background: #fef2f2;
        color: #991b1b;
    }

    .alert-danger.modern i {
        margin-right: 0.5rem;
    }

    .btn-close {
        filter: brightness(0) saturate(100%) invert(15%) sepia(96%) saturate(4461%) hue-rotate(353deg) brightness(75%) contrast(106%);
    }

    @media (max-width: 768px) {
        .register-card {
            margin: 1rem;
        }

        .card-body.enhanced {
            padding: 1.5rem 1rem 1rem;
        }
    }

    .register-page {
        height: 100vh;
        overflow: hidden;
    }

    .min-vh-100 {
        min-height: 100vh !important;
    }
</style>

<div class="container-fluid register-page">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-11 col-sm-9 col-md-7 col-lg-5 col-xl-4">
            <div class="card register-card shadow-lg">
                <div class="card-header gradient-header text-white text-center">
                    <div class="logo-circle">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h3 class="mb-2">Daftar Akun Baru</h3>
                    <p class="mb-0">Buat akun untuk mengakses sistem tiket</p>
                </div>

                <div class="card-body enhanced">
                    @if(session('success'))
                        <div class="alert alert-success modern alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user"></i> Nama Lengkap
                                    </label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           class="form-control modern @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}"
                                           placeholder="Masukkan nama lengkap"
                                           required
                                           autofocus>
                                @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope"></i> Email
                                    </label>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           class="form-control modern @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}"
                                           placeholder="nama@contoh.com"
                                           required>
                                @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock"></i> Password
                                    </label>
                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="form-control modern @error('password') is-invalid @enderror"
                                           placeholder="Minimal 8 karakter"
                                           required>
                                @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="fas fa-lock"></i> Konfirmasi Password
                                    </label>
                                    <input type="password"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           class="form-control modern"
                                           placeholder="Ulangi password"
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">
                                <i class="fas fa-user-tag"></i> Role
                            </label>
                            <select name="role"
                                    id="role"
                                    class="form-select modern @error('role') is-invalid @enderror"
                                    required>
                                <option value="">Pilih Role</option>
                                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="CS" {{ old('role') == 'CS' ? 'selected' : '' }}>Customer Service</option>
                                <option value="NOC" {{ old('role') == 'NOC' ? 'selected' : '' }}>Network Operations Center</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox"
                                       class="form-check-input"
                                       id="terms"
                                       required>
                                <label class="form-check-label" for="terms">
                                    Saya menyetujui <a href="#" class="text-decoration-none">syarat dan ketentuan</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-gradient w-100 mb-2">
                            <i class="fas fa-user-plus"></i> Daftar
                        </button>
                    </form>

                    <div class="register-section text-center">
                        <small class="text-muted">
                            Sudah punya akun?
                            <a href="{{ route('login') }}">Login di sini</a>
                        </small>
                    </div>
                </div>
            </div>

            <div class="text-center mt-3">
                <small class="text-white">
                    &copy; {{ date('Y') }} ISP Ticket System. All rights reserved.
                </small>
            </div>
        </div>
    </div>
</div>
@endsection
