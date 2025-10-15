@extends('layouts.sidebar')

@section('content')
<style>
    .customer-form-wrapper {
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

    .form-group-modern {
        margin-bottom: 1.5rem;
    }

    .form-label-modern {
        font-weight: 600;
        color: #2d3748;
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

    .form-control-modern {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .form-control-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
        background: white;
        transform: translateY(-2px);
    }

    .form-control-modern:hover {
        border-color: #cbd5e0;
        background: white;
    }

    .form-control-modern.is-invalid {
        border-color: #f56565;
        background: white;
    }

    .form-control-modern.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(245, 101, 101, 0.1);
    }

    .invalid-feedback {
        color: #f56565;
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .invalid-feedback::before {
        content: '⚠';
        font-size: 0.75rem;
    }

    .required-star {
        color: #f56565;
        font-weight: 700;
    }

    .form-actions {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 10px;
        padding: 1.5rem;
        margin-top: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        animation: fadeInUp 0.7s ease-out;
        animation-fill-mode: both;
    }

    .btn-action {
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-action i {
        font-size: 0.9rem;
    }

    .btn-back {
        background: white;
        color: #64748b;
        border: 2px solid #e2e8f0;
    }

    .btn-back:hover {
        background: #f8fafc;
        border-color: #cbd5e0;
        color: #475569;
    }

    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        flex: 1;
        justify-content: center;
    }

    .btn-save:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        color: white;
    }

    .form-section {
        background: #f8fafc;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #e2e8f0;
    }

    .form-section-title {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1rem;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-section-title i {
        color: #667eea;
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .form-card .card-body {
            padding: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .form-header h2 {
            font-size: 1.25rem;
        }

        .form-header p {
            font-size: 0.85rem;
        }
    }
</style>

<div class="customer-form-wrapper">
    <div class="container-fluid">
        <!-- Form Header -->
        <div class="form-header">
            <h2>
                <i class="fas fa-user-plus"></i>
                {{ isset($customer) ? 'Edit Pelanggan' : 'Tambah Pelanggan Baru' }}
            </h2>
            <p>{{ isset($customer) ? 'Perbarui informasi pelanggan yang ada' : 'Lengkapi formulir di bawah untuk menambahkan pelanggan baru' }}</p>
        </div>

        <!-- Form Card -->
        <div class="card form-card">
            <div class="card-body">
                <form action="{{ isset($customer) ? route('customers.update', $customer->id) : route('customers.store') }}"
                      method="{{ isset($customer) ? 'PUT' : 'POST' }}">
                    @csrf

                    <!-- Basic Information Section -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-user"></i>
                            Informasi Dasar
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label for="name" class="form-label-modern">
                                        <i class="fas fa-user"></i>
                                        Nama Lengkap <span class="required-star">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-modern @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name', isset($customer) ? $customer->name : '') }}"
                                           placeholder="Masukkan nama lengkap"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label for="email" class="form-label-modern">
                                        <i class="fas fa-envelope"></i>
                                        Email <span class="required-star">*</span>
                                    </label>
                                    <input type="email"
                                           class="form-control form-control-modern @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email', isset($customer) ? $customer->email : '') }}"
                                           placeholder="email@example.com"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label for="phone" class="form-label-modern">
                                        <i class="fas fa-phone"></i>
                                        Nomor Telepon <span class="required-star">*</span>
                                    </label>
                                    <input type="tel"
                                           class="form-control form-control-modern @error('phone') is-invalid @enderror"
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone', isset($customer) ? $customer->phone : '') }}"
                                           placeholder="+62 812-3456-7890"
                                           required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label for="company" class="form-label-modern">
                                        <i class="fas fa-building"></i>
                                        Perusahaan
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-modern @error('company') is-invalid @enderror"
                                           id="company"
                                           name="company"
                                           value="{{ old('company', isset($customer) ? $customer->company : '') }}"
                                           placeholder="Nama perusahaan (opsional)">
                                    @error('company')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information Section -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-map-marker-alt"></i>
                            Informasi Alamat
                        </div>

                        <div class="form-group-modern">
                            <label for="address" class="form-label-modern">
                                <i class="fas fa-home"></i>
                                Alamat Lengkap <span class="required-star">*</span>
                            </label>
                            <textarea class="form-control form-control-modern @error('address') is-invalid @enderror"
                                      id="address"
                                      name="address"
                                      rows="3"
                                      placeholder="Masukkan alamat lengkap"
                                      required>{{ old('address', isset($customer) ? $customer->address : '') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label for="city" class="form-label-modern">
                                        <i class="fas fa-city"></i>
                                        Kota
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-modern @error('city') is-invalid @enderror"
                                           id="city"
                                           name="city"
                                           value="{{ old('city', isset($customer) ? $customer->city : '') }}"
                                           placeholder="Nama kota">
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label for="postal_code" class="form-label-modern">
                                        <i class="fas fa-mail-bulk"></i>
                                        Kode Pos
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-modern @error('postal_code') is-invalid @enderror"
                                           id="postal_code"
                                           name="postal_code"
                                           value="{{ old('postal_code', isset($customer) ? $customer->postal_code : '') }}"
                                           placeholder="12345">
                                    @error('postal_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('customers.index') }}" class="btn-action btn-back">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn-action btn-save">
                            <i class="fas fa-save"></i>
                            {{ isset($customer) ? 'Update Pelanggan' : 'Simpan Pelanggan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
