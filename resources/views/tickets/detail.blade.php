@extends('layouts.sidebar')

@section('title', 'Detail Tiket #' . $ticket->id)

@section('content')
<style>
    .ticket-detail-wrapper {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 1.5rem 0;
    }

    .detail-header {
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

    .detail-header::before {
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

    .detail-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .detail-header p {
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
        font-size: 0.9rem;
    }

    .ticket-card {
        background: white;
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
        margin-bottom: 1.5rem;
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

    .ticket-card .card-header {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border: none;
        border-bottom: 2px solid #e2e8f0;
        padding: 1.25rem 1.5rem;
        border-radius: 12px 12px 0 0;
    }

    .ticket-card .card-header h5 {
        font-weight: 700;
        color: #2d3748;
        margin: 0;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .ticket-card .card-header h5 i {
        color: #667eea;
        font-size: 1rem;
    }

    .ticket-card .card-body {
        padding: 1.5rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }

    .info-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .info-content {
        flex: 1;
    }

    .info-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-size: 0.95rem;
        color: #2d3748;
        font-weight: 500;
    }

    .badge-modern {
        padding: 0.4rem 0.85rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-modern.open {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .badge-modern.in-progress {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .badge-modern.resolved {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .badge-modern.closed {
        background: linear-gradient(135deg, #a8a8a8 0%, #7f7f7f 100%);
        color: white;
    }

    .badge-modern.low {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .badge-modern.medium {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }

    .badge-modern.high {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .badge-modern.critical {
        background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
        color: white;
    }

    .status-form {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 10px;
        padding: 1.5rem;
        border: 1px solid #e2e8f0;
    }

    .form-select-modern {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: white;
        margin-bottom: 1rem;
    }

    .form-select-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
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
        width: 100%;
        justify-content: center;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-action i {
        font-size: 0.9rem;
    }

    .btn-update-status {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-update-status:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #e887f4 0%, #e6465a 100%);
        color: white;
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

    .action-buttons {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
        flex-wrap: wrap;
    }

    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.5s ease-out;
        animation-fill-mode: both;
    }

    .timeline-item:nth-child(1) { animation-delay: 0.1s; }
    .timeline-item:nth-child(2) { animation-delay: 0.15s; }
    .timeline-item:nth-child(3) { animation-delay: 0.2s; }
    .timeline-item:nth-child(4) { animation-delay: 0.25s; }

    .timeline-marker {
        position: absolute;
        left: -30px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 0 3px #667eea;
        background: white;
    }

    .timeline-content {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding: 1rem 1.25rem;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .timeline-content:hover {
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }

    .timeline-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .timeline-status {
        font-weight: 600;
        color: #2d3748;
        font-size: 0.9rem;
    }

    .timeline-time {
        font-size: 0.8rem;
        color: #64748b;
        white-space: nowrap;
    }

    .timeline-user {
        font-size: 0.85rem;
        color: #4a5568;
        margin-bottom: 0.25rem;
    }

    .description-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.25rem;
        margin-top: 1rem;
    }

    .description-text {
        color: #475569;
        line-height: 1.6;
        margin: 0;
        white-space: pre-wrap;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .detail-header h2 {
            font-size: 1.25rem;
        }

        .timeline {
            padding-left: 20px;
        }

        .timeline::before {
            left: 10px;
        }

        .timeline-marker {
            left: -20px;
        }
    }
</style>

<div class="ticket-detail-wrapper">
    <div class="container-fluid">
        <!-- Detail Header -->
        <div class="detail-header">
            <h2>
                <i class="fas fa-ticket-alt"></i>
                Detail Tiket #{{ $ticket->id }}
            </h2>
            <p>Lihat informasi lengkap tiket dan kelola statusnya</p>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" style="border-radius: 10px; border: none; background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%); color: #155724; margin-bottom: 1.5rem;">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" style="border-radius: 10px; border: none; background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%); color: #721c24; margin-bottom: 1.5rem;">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Ticket Information -->
                <div class="ticket-card">
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-info-circle"></i>
                            Informasi Tiket
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">ID Tiket</div>
                                    <div class="info-value">#{{ $ticket->id }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-flag"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Status</div>
                                    <div class="info-value">
                                        <span class="badge-modern {{ strtolower(str_replace(' ', '-', $ticket->status)) }}">
                                            {{ $ticket->status }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Prioritas</div>
                                    <div class="info-value">
                                        <span class="badge-modern {{ strtolower($ticket->priority) }}">
                                            {{ $ticket->priority }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            @if($ticket->category)
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Kategori</div>
                                    <div class="info-value">{{ $ticket->category }}</div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="description-box">
                            <h6 style="color: #2d3748; font-weight: 600; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-align-left" style="color: #667eea; font-size: 0.9rem;"></i>
                                Deskripsi Gangguan
                            </h6>
                            <p class="description-text">{{ $ticket->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="ticket-card">
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-user"></i>
                            Informasi Pelanggan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Nama</div>
                                    <div class="info-value">{{ $ticket->customer->name }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Email</div>
                                    <div class="info-value">{{ $ticket->customer->email }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Telepon</div>
                                    <div class="info-value">{{ $ticket->customer->phone ?? 'Tidak tersedia' }}</div>
                                </div>
                            </div>

                            @if($ticket->customer->address)
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Alamat</div>
                                    <div class="info-value">{{ $ticket->customer->address }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="ticket-card">
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-history"></i>
                            Timeline Perubahan Status
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($ticket->logs->count() > 0)
                            <div class="timeline">
                                @foreach($ticket->logs->sortByDesc('created_at') as $log)
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <div class="timeline-header">
                                            <div>
                                                <div class="timeline-status">
                                                    Status berubah ke:
                                                    <span class="badge-modern {{ strtolower(str_replace(' ', '-', $log->status)) }}">
                                                        {{ $log->status }}
                                                    </span>
                                                </div>
                                                <div class="timeline-user">
                                                    <i class="fas fa-user" style="color: #667eea; font-size: 0.75rem; margin-right: 0.25rem;"></i>
                                                    {{ $log->user->name ?? 'System' }}
                                                </div>
                                            </div>
                                            <div class="timeline-time">
                                                {{ $log->created_at->format('d/m/Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div style="text-align: center; padding: 2rem; color: #94a3b8;">
                                <i class="fas fa-clock" style="font-size: 2rem; margin-bottom: 0.5rem; opacity: 0.3;"></i>
                                <p style="margin: 0;">Belum ada perubahan status</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Status Update -->
                <div class="ticket-card">
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-sync"></i>
                            Update Status
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="status-form">
                                <label style="font-weight: 600; color: #2d3748; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">
                                    Pilih Status Baru
                                </label>
                                <select class="form-select-modern" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
                                    <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Resolved" {{ $ticket->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                </select>

                                <button type="submit" class="btn-action btn-update-status">
                                    <i class="fas fa-sync"></i>
                                    Update Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="ticket-card">
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-bolt"></i>
                            Aksi Cepat
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="action-buttons">
                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn-action btn-edit">
                                <i class="fas fa-edit"></i>
                                Edit Tiket
                            </a>
                            <a href="{{ route('tickets.index') }}" class="btn-action btn-back">
                                <i class="fas fa-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Ticket Meta Info -->
                <div class="ticket-card">
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-info"></i>
                            Informasi Tambahan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 8px;">
                                <span style="font-size: 0.85rem; color: #64748b;">Dibuat:</span>
                                <span style="font-size: 0.85rem; font-weight: 500; color: #2d3748;">{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 8px;">
                                <span style="font-size: 0.85rem; color: #64748b;">Diupdate:</span>
                                <span style="font-size: 0.85rem; font-weight: 500; color: #2d3748;">{{ $ticket->updated_at->format('d/m/Y H:i') }}</span>
                            </div>

                            @if($ticket->assigned_to)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 8px;">
                                <span style="font-size: 0.85rem; color: #64748b;">Ditugaskan ke:</span>
                                <span style="font-size: 0.85rem; font-weight: 500; color: #2d3748;">Agent {{ $ticket->assigned_to }}</span>
                            </div>
                            @endif

                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 8px;">
                                <span style="font-size: 0.85rem; color: #64748b;">Total Log:</span>
                                <span style="font-size: 0.85rem; font-weight: 500; color: #2d3748;">{{ $ticket->logs->count() }} perubahan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection