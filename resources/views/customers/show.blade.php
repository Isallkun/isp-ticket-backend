@extends('layouts.sidebar')

@section('title', 'Detail Pelanggan')

@section('content')
<style>
    .customer-detail-wrapper {
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

    .customer-card {
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

    .customer-card .card-header {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border: none;
        border-bottom: 2px solid #e2e8f0;
        padding: 1.25rem 1.5rem;
        border-radius: 12px 12px 0 0;
    }

    .customer-card .card-header h5 {
        font-weight: 700;
        color: #2d3748;
        margin: 0;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .customer-card .card-header h5 i {
        color: #667eea;
        font-size: 1rem;
    }

    .customer-card .card-body {
        padding: 1.5rem;
    }

    .customer-avatar-large {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 2rem;
        margin: 0 auto 1rem;
        border: 4px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .customer-name-large {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
        text-align: center;
        margin-bottom: 0.25rem;
    }

    .customer-email-large {
        color: #64748b;
        text-align: center;
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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

    .tickets-table {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .table-modern {
        margin: 0;
        font-size: 0.875rem;
    }

    .table-modern thead th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        padding: 1rem;
        white-space: nowrap;
    }

    .table-modern thead th:first-child {
        border-radius: 10px 0 0 0;
    }

    .table-modern thead th:last-child {
        border-radius: 0 10px 0 0;
    }

    .table-modern tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #475569;
    }

    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }

    .table-modern tbody tr:hover {
        background: #f8fafc;
    }

    .badge-modern {
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
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

    .action-buttons {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
        flex-wrap: wrap;
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

    .btn-ticket {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-ticket:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #94a3b8;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    .empty-state p {
        font-size: 1rem;
        font-weight: 500;
        margin: 0;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .customer-avatar-large {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        .customer-name-large {
            font-size: 1.25rem;
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
    }
</style>

<div class="customer-detail-wrapper">
    <div class="container-fluid">
        <!-- Detail Header -->
        <div class="detail-header">
            <h2>
                <i class="fas fa-user"></i>
                Detail Pelanggan
            </h2>
            <p>Lihat informasi lengkap pelanggan dan riwayat tiket</p>
        </div>

        <!-- Customer Profile Card -->
        <div class="card customer-card">
            <div class="card-body">
                <div class="customer-avatar-large">
                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                </div>
                <div class="customer-name-large">{{ $customer->name }}</div>
                <div class="customer-email-large">{{ $customer->email }}</div>

                <!-- Action Buttons -->
                <div class="action-buttons justify-content-center">
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn-action btn-edit">
                        <i class="fas fa-edit"></i>
                        Edit Pelanggan
                    </a>
                    <a href="{{ route('tickets.create', ['customer_id' => $customer->id]) }}" class="btn-action btn-ticket">
                        <i class="fas fa-plus"></i>
                        Buat Tiket Baru
                    </a>
                    <a href="{{ route('customers.index') }}" class="btn-action btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="card customer-card">
            <div class="card-header">
                <h5>
                    <i class="fas fa-info-circle"></i>
                    Informasi Pelanggan
                </h5>
            </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Nama Lengkap</div>
                            <div class="info-value">{{ $customer->name }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $customer->email }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Telepon</div>
                            <div class="info-value">{{ $customer->phone ?? 'Tidak tersedia' }}</div>
                        </div>
                    </div>

                    @if($customer->company)
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Perusahaan</div>
                            <div class="info-value">{{ $customer->company }}</div>
                        </div>
                    </div>
                    @endif

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Alamat</div>
                            <div class="info-value">{{ $customer->address ?? 'Tidak tersedia' }}</div>
                        </div>
                    </div>

                    @if($customer->city || $customer->postal_code)
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Kota / Kode Pos</div>
                            <div class="info-value">
                                {{ $customer->city ?? '-' }}{{ $customer->city && $customer->postal_code ? ', ' : '' }}{{ $customer->postal_code ?? '' }}
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Terdaftar Sejak</div>
                            <div class="info-value">{{ $customer->created_at->format('d F Y, H:i') }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Update Terakhir</div>
                            <div class="info-value">{{ $customer->updated_at->format('d F Y, H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Tickets -->
        <div class="card customer-card">
            <div class="card-header">
                <h5>
                    <i class="fas fa-ticket-alt"></i>
                    Riwayat Tiket ({{ $customer->tickets->count() }})
                </h5>
            </div>
            <div class="card-body">
                @if($customer->tickets->count() > 0)
                    <div class="tickets-table">
                        <table class="table table-modern">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Prioritas</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer->tickets->sortByDesc('created_at') as $ticket)
                                <tr>
                                    <td>
                                        <strong style="color: #667eea;">#{{ $ticket->id }}</strong>
                                    </td>
                                    <td>{{ Str::limit($ticket->title, 50) }}</td>
                                    <td>
                                        <span class="badge-modern {{ strtolower(str_replace(' ', '-', $ticket->status)) }}">
                                            {{ $ticket->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-modern" style="
                                            @if($ticket->priority === 'High') background: linear-gradient(135deg, #f5576c 0%, #e63946 100%);
                                            @elseif($ticket->priority === 'Medium') background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                                            @else background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
                                            @endif color: white;
                                        ">
                                            {{ $ticket->priority ?? 'Normal' }}
                                        </span>
                                    </td>
                                    <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn-action btn-edit" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">
                                            <i class="fas fa-eye"></i>
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Belum ada tiket untuk pelanggan ini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection