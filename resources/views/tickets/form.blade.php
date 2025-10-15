@extends('layouts.sidebar')

@section('content')
<style>
    .ticket-form-wrapper {
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

    .breadcrumb-custom {
        background: transparent;
        padding: 0;
        margin: 0;
        font-size: 0.85rem;
    }

    .breadcrumb-custom .breadcrumb-item {
        color: rgba(255, 255, 255, 0.8);
    }

    .breadcrumb-custom .breadcrumb-item.active {
        color: white;
        font-weight: 600;
    }

    .breadcrumb-custom .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
    }

    .breadcrumb-custom .breadcrumb-item a:hover {
        color: white;
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

    textarea.form-control-modern {
        resize: vertical;
        min-height: 120px;
    }

    .form-helper-text {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-top: 0.35rem;
        font-style: italic;
    }

    .priority-badges {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .priority-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .priority-badge.low {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .priority-badge.medium {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }

    .priority-badge.high {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .priority-badge.critical {
        background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
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

    /* Info Box */
    .info-box {
        background: linear-gradient(135deg, #e0e7ff 0%, #e0f2fe 100%);
        border-left: 4px solid #667eea;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: start;
        gap: 1rem;
    }

    .info-box-icon {
        color: #667eea;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .info-box-content {
        flex: 1;
    }

    .info-box-title {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.25rem;
        font-size: 0.95rem;
    }

    .info-box-text {
        color: #64748b;
        font-size: 0.85rem;
        margin: 0;
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

        .info-box {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<div class="ticket-form-wrapper">
    <div class="container-fluid">
        <!-- Form Header -->
        <div class="form-header">
            <h2>
                <i class="fas fa-plus-circle"></i>
                {{ isset($ticket) ? 'Edit Tiket Gangguan' : 'Buat Tiket Gangguan Baru' }}
            </h2>
            <p>{{ isset($ticket) ? 'Perbarui informasi tiket gangguan yang ada' : 'Lengkapi formulir di bawah untuk membuat tiket gangguan baru' }}</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}">Tiket</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ isset($ticket) ? 'Edit' : 'Buat Baru' }}</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Info Box -->
                <div class="info-box">
                    <div class="info-box-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="info-box-content">
                        <div class="info-box-title">Informasi</div>
                        <p class="info-box-text">
                            Lengkapi formulir di bawah ini untuk membuat tiket gangguan baru.
                            Field yang ditandai dengan <span class="required-mark">*</span> wajib diisi.
                        </p>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="card form-card">
                    <div class="card-body">
                        <form action="{{ isset($ticket) ? route('tickets.update', $ticket->id) : route('tickets.store') }}"
                              method="{{ isset($ticket) ? 'PUT' : 'POST' }}">
                            @csrf
                            @if(isset($ticket))
                                @method('PUT')
                            @endif

                            <!-- Section 1: Informasi Pelanggan -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-user"></i>
                                    Informasi Pelanggan
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_id" class="form-label-modern">
                                                <i class="fas fa-user-circle"></i>
                                                Pelanggan
                                                <span class="required-mark">*</span>
                                            </label>
                                            <select class="form-select form-select-modern @error('customer_id') is-invalid @enderror"
                                                    id="customer_id"
                                                    name="customer_id"
                                                    required>
                                                <option value="">Pilih Pelanggan</option>
                                                @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                        {{ old('customer_id', isset($selectedCustomerId) ? $selectedCustomerId : (isset($ticket) ? $ticket->customer_id : '')) == $customer->id ? 'selected' : '' }}>
                                                    {{ $customer->name }} - {{ $customer->phone }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-helper-text">Pilih pelanggan yang melaporkan gangguan</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="priority" class="form-label-modern">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                Prioritas
                                                <span class="required-mark">*</span>
                                            </label>
                                            <select class="form-select form-select-modern @error('priority') is-invalid @enderror"
                                                    id="priority"
                                                    name="priority"
                                                    required>
                                                <option value="">Pilih Prioritas</option>
                                                <option value="Low" {{ old('priority', isset($ticket) ? $ticket->priority : '') == 'Low' ? 'selected' : '' }}>Low - Rendah</option>
                                                <option value="Medium" {{ old('priority', isset($ticket) ? $ticket->priority : '') == 'Medium' ? 'selected' : '' }}>Medium - Sedang</option>
                                                <option value="High" {{ old('priority', isset($ticket) ? $ticket->priority : '') == 'High' ? 'selected' : '' }}>High - Tinggi</option>
                                                <option value="Critical" {{ old('priority', isset($ticket) ? $ticket->priority : '') == 'Critical' ? 'selected' : '' }}>Critical - Kritis</option>
                                            </select>
                                            @error('priority')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="priority-badges">
                                                <span class="priority-badge low">Low</span>
                                                <span class="priority-badge medium">Medium</span>
                                                <span class="priority-badge high">High</span>
                                                <span class="priority-badge critical">Critical</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Detail Gangguan -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-clipboard-list"></i>
                                    Detail Gangguan
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label-modern">
                                        <i class="fas fa-heading"></i>
                                        Judul Gangguan
                                        <span class="required-mark">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-modern @error('title') is-invalid @enderror"
                                           id="title"
                                           name="title"
                                           value="{{ old('title', isset($ticket) ? $ticket->title : '') }}"
                                           placeholder="Contoh: Internet tidak bisa terhubung"
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-helper-text">Berikan judul yang jelas dan singkat</div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label-modern">
                                        <i class="fas fa-align-left"></i>
                                        Deskripsi Gangguan
                                        <span class="required-mark">*</span>
                                    </label>
                                    <textarea class="form-control form-control-modern @error('description') is-invalid @enderror"
                                              id="description"
                                              name="description"
                                              rows="5"
                                              placeholder="Jelaskan detail gangguan yang dialami..."
                                              required>{{ old('description', isset($ticket) ? $ticket->description : '') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-helper-text">Jelaskan masalah secara detail untuk mempercepat penanganan</div>
                                </div>
                            </div>

                            <!-- Section 3: Kategori & Penugasan -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-cog"></i>
                                    Kategori & Penugasan
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category" class="form-label-modern">
                                                <i class="fas fa-tags"></i>
                                                Kategori
                                            </label>
                                            <select class="form-select form-select-modern @error('category') is-invalid @enderror"
                                                    id="category"
                                                    name="category">
                                                <option value="">Pilih Kategori</option>
                                                <option value="Internet" {{ old('category', isset($ticket) ? $ticket->category : '') == 'Internet' ? 'selected' : '' }}>Internet</option>
                                                <option value="Telepon" {{ old('category', isset($ticket) ? $ticket->category : '') == 'Telepon' ? 'selected' : '' }}>Telepon</option>
                                                <option value="TV" {{ old('category', isset($ticket) ? $ticket->category : '') == 'TV' ? 'selected' : '' }}>TV</option>
                                                <option value="Lainnya" {{ old('category', isset($ticket) ? $ticket->category : '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-helper-text">Kategori jenis layanan yang bermasalah</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="assigned_to" class="form-label-modern">
                                                <i class="fas fa-user-tag"></i>
                                                Ditugaskan Ke
                                            </label>
                                            <select class="form-select form-select-modern @error('assigned_to') is-invalid @enderror"
                                                    id="assigned_to"
                                                    name="assigned_to">
                                                <option value="">Pilih Agent</option>
                                                <option value="1" {{ old('assigned_to') == '1' ? 'selected' : '' }}>Agent 1</option>
                                                <option value="2" {{ old('assigned_to') == '2' ? 'selected' : '' }}>Agent 2</option>
                                            </select>
                                            @error('assigned_to')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-helper-text">Opsional, bisa diisi kemudian</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <a href="{{ route('tickets.index') }}" class="btn-modern btn-back">
                                    <i class="fas fa-arrow-left"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn-modern btn-submit">
                                    <i class="fas fa-paper-plane"></i>
                                    {{ isset($ticket) ? 'Update Tiket' : 'Buat Tiket' }}
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

