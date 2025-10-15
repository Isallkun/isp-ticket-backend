@extends('layouts.sidebar')

@section('title', isset($user) ? 'Edit User' : 'Tambah User Baru')

@section('content')
<style>
    .user-form-wrapper {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 1.5rem 0;
    }

    .form-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
        animation: fadeInDown 0.5s ease-out;
    }

    .form-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(180deg); }
    }

    .form-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-header p {
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
        font-size: 0.9rem;
    }

    .form-card {
        background: white;
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
        overflow: hidden;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-card .card-body {
        padding: 2rem;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .form-section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-section-title i {
        color: #667eea;
        font-size: 1rem;
    }

    .form-label-modern {
        font-weight: 600;
        color: #4a5568;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label-modern i {
        color: #667eea;
        font-size: 0.85rem;
    }

    .required-mark {
        color: #f5576c;
        font-weight: 700;
    }

    .form-control-modern,
    .form-select-modern {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .form-control-modern:focus,
    .form-select-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
        outline: none;
    }

    .form-control-modern.is-invalid,
    .form-select-modern.is-invalid {
        border-color: #f5576c;
        background: #fff5f5;
    }

    .form-control-modern.is-invalid:focus,
    .form-select-modern.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(245, 87, 108, 0.1);
    }

    .invalid-feedback {
        color: #f5576c;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .invalid-feedback::before {
        content: "⚠";
        font-size: 1rem;
    }

    .form-helper-text {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-top: 0.35rem;
        font-style: italic;
    }

    .role-badges {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .role-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .role-badge.admin {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .role-badge.cs {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .role-badge.noc {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        padding-top: 2rem;
        border-top: 2px solid #f1f5f9;
        margin-top: 2rem;
    }

    .btn-modern {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-back {
        background: white;
        border: 2px solid #e2e8f0;
        color: #4a5568;
    }

    .btn-back:hover {
        background: #f8fafc;
        border-color: #cbd5e0;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        color: #4a5568;
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        margin-left: auto;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-modern i {
        font-size: 0.9rem;
    }

    .alert-modern {
        border-radius: 10px;
        border: none;
        padding: 1rem 1.25rem;
        animation: slideDown 0.4s ease-out;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
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

    .alert-success.alert-modern {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
    }

    .alert-danger.alert-modern {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
    }

    .alert-modern i {
        font-size: 1.2rem;
    }

    @media (max-width: 768px) {
        .form-card .card-body {
            padding: 1.5rem;
        }

        .form-section-title {
            font-size: 1rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-submit {
            margin-left: 0;
            order: -1;
        }
    }
</style>

<div class="user-form-wrapper">
    <div class="container-fluid">
        <!-- Form Header -->
        <div class="form-header">
            <h2>
                <i class="fas fa-user-shield"></i>
                {{ isset($user) ? 'Edit User' : 'Tambah User Baru' }}
            </h2>
            <p>{{ isset($user) ? 'Perbarui informasi user yang ada' : 'Lengkapi formulir di bawah untuk membuat user baru' }}</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Form Card -->
                <div class="card form-card">
                    <div class="card-body">
                        <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                              method="{{ isset($user) ? 'PUT' : 'POST' }}">
                            @csrf
                            @if(isset($user))
                                @method('PUT')
                            @endif

                            <!-- Section 1: Informasi User -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-user"></i>
                                    Informasi User
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label-modern">
                                                <i class="fas fa-user"></i>
                                                Nama Lengkap
                                                <span class="required-mark">*</span>
                                            </label>
                                            <input type="text"
                                                   class="form-control form-control-modern @error('name') is-invalid @enderror"
                                                   id="name"
                                                   name="name"
                                                   value="{{ old('name', isset($user) ? $user->name : '') }}"
                                                   placeholder="Masukkan nama lengkap"
                                                   required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label-modern">
                                                <i class="fas fa-envelope"></i>
                                                Email
                                                <span class="required-mark">*</span>
                                            </label>
                                            <input type="email"
                                                   class="form-control form-control-modern @error('email') is-invalid @enderror"
                                                   id="email"
                                                   name="email"
                                                   value="{{ old('email', isset($user) ? $user->email : '') }}"
                                                   placeholder="nama@contoh.com"
                                                   required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Role & Security -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-shield-alt"></i>
                                    Role & Keamanan
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="role" class="form-label-modern">
                                                <i class="fas fa-user-tag"></i>
                                                Role
                                                <span class="required-mark">*</span>
                                            </label>
                                            <select class="form-select form-select-modern @error('role') is-invalid @enderror"
                                                    id="role"
                                                    name="role"
                                                    required>
                                                <option value="">Pilih Role</option>
                                                @foreach($roles as $roleKey => $roleName)
                                                <option value="{{ $roleKey }}"
                                                        {{ old('role', isset($user) ? $user->role : '') == $roleKey ? 'selected' : '' }}>
                                                    {{ $roleName }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="role-badges">
                                                <span class="role-badge admin">Admin</span>
                                                <span class="role-badge cs">Customer Service</span>
                                                <span class="role-badge noc">NOC Agent</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label-modern">
                                                <i class="fas fa-lock"></i>
                                                Password
                                                @if(!isset($user))<span class="required-mark">*</span>@endif
                                            </label>
                                            <input type="password"
                                                   class="form-control form-control-modern @error('password') is-invalid @enderror"
                                                   id="password"
                                                   name="password"
                                                   placeholder="{{ isset($user) ? 'Kosongkan jika tidak ingin diubah' : 'Minimal 6 karakter' }}"
                                                   {{ isset($user) ? '' : 'required' }}>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                @if(!isset($user))
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label-modern">
                                                <i class="fas fa-lock"></i>
                                                Konfirmasi Password
                                                <span class="required-mark">*</span>
                                            </label>
                                            <input type="password"
                                                   class="form-control form-control-modern"
                                                   id="password_confirmation"
                                                   name="password_confirmation"
                                                   placeholder="Ulangi password"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <a href="{{ route('users.index') }}" class="btn-modern btn-back">
                                    <i class="fas fa-arrow-left"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn-modern btn-submit">
                                    <i class="fas fa-save"></i>
                                    {{ isset($user) ? 'Update User' : 'Simpan User' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection