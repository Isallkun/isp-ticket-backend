@extends('layouts.sidebar')
@section('title', 'Dashboard')

@section('content')
<style>
    .dashboard-wrapper {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 1.5rem 0;
    }

    .dashboard-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
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

    .dashboard-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }

    .dashboard-header h2 i {
        margin-right: 0.5rem;
    }

    .welcome-text {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.9rem;
        margin: 0;
    }

    .welcome-text strong {
        font-weight: 600;
    }

    /* Statistics Cards - LEBIH KECIL */
    .stat-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        animation: fadeInUp 0.5s ease-out;
        animation-fill-mode: both;
        height: 100%;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.15s; }
    .stat-card:nth-child(3) { animation-delay: 0.2s; }
    .stat-card:nth-child(4) { animation-delay: 0.25s; }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .stat-card.primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .stat-card.warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .stat-card.info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .stat-card.success {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .stat-card .card-body {
        padding: 1rem;
    }

    .stat-card .card-title {
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .stat-card h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
    }

    .stat-card i {
        opacity: 0.25;
        font-size: 2rem;
    }

    /* Quick Actions - LEBIH KECIL */
    .quick-actions-card {
        background: white;
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        animation: fadeInUp 0.5s ease-out 0.3s;
        animation-fill-mode: both;
    }

    .quick-actions-card .card-header {
        background: white;
        border: none;
        border-bottom: 2px solid #f1f5f9;
        padding: 1rem 1.25rem;
    }

    .quick-actions-card .card-header h5 {
        font-weight: 700;
        color: #2d3748;
        margin: 0;
        font-size: 1rem;
    }

    .quick-actions-card .card-body {
        padding: 1.25rem;
    }

    .btn-action {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-action i {
        margin-right: 0.4rem;
        font-size: 0.9rem;
    }

    .btn-action.primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-action.success {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .btn-action.info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .btn-action.warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    /* Recent Tickets Card - LEBIH KECIL */
    .tickets-card {
        background: white;
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        animation: fadeInUp 0.5s ease-out 0.4s;
        animation-fill-mode: both;
    }

    .tickets-card .card-header {
        background: white;
        border: none;
        border-bottom: 2px solid #f1f5f9;
        padding: 1rem 1.25rem;
    }

    .tickets-card .card-header h5 {
        font-weight: 700;
        color: #2d3748;
        margin: 0;
        font-size: 1rem;
    }

    .tickets-card .card-body {
        padding: 0;
    }

    .table-modern {
        margin: 0;
        font-size: 0.875rem;
    }

    .table-modern thead th {
        background: #f8fafc;
        color: #64748b;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: none;
        padding: 0.75rem 1rem;
    }

    .table-modern tbody td {
        padding: 0.75rem 1rem;
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

    .badge-modern.warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .badge-modern.info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .badge-modern.success {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .badge-modern.secondary {
        background: linear-gradient(135deg, #a8a8a8 0%, #7f7f7f 100%);
    }

    /* Chart Card - LEBIH KECIL */
    .chart-card {
        background: white;
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        animation: fadeInUp 0.5s ease-out 0.5s;
        animation-fill-mode: both;
    }

    .chart-card .card-header {
        background: white;
        border: none;
        border-bottom: 2px solid #f1f5f9;
        padding: 1rem 1.25rem;
    }

    .chart-card .card-header h5 {
        font-weight: 700;
        color: #2d3748;
        margin: 0;
        font-size: 1rem;
    }

    .chart-card .card-body {
        padding: 1.25rem;
    }

    .empty-state {
        text-align: center;
        padding: 2rem 1rem;
        color: #94a3b8;
    }

    .empty-state i {
        font-size: 2.5rem;
        margin-bottom: 0.75rem;
        opacity: 0.5;
    }

    .empty-state p {
        margin: 0;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .dashboard-wrapper {
            padding: 1rem 0;
        }

        .dashboard-header {
            padding: 1rem;
        }

        .dashboard-header h2 {
            font-size: 1.25rem;
        }

        .stat-card h2 {
            font-size: 1.5rem;
        }

        .btn-action {
            margin-bottom: 0.5rem;
            font-size: 0.8rem;
            padding: 0.65rem 0.85rem;
        }

        .table-modern {
            font-size: 0.8rem;
        }
    }
</style>

<div class="dashboard-wrapper">
    <div class="container-fluid">
        <!-- Header -->
        <div class="dashboard-header d-flex justify-content-between align-items-center">
            <h2>
                <i class="fas fa-tachometer-alt"></i>Dashboard
            </h2>
            <p class="welcome-text">
                Selamat datang, <strong>{{ auth()->user()->name }}</strong>!
            </p>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-3 g-3">
            <div class="col-md-6 col-lg-3">
                <div class="card stat-card primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">Total Tiket</h4>
                                <h2>{{ \App\Models\Ticket::count() }}</h2>
                            </div>
                            <div>
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card stat-card warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">Tiket Open</h4>
                                <h2>{{ \App\Models\Ticket::where('status', 'Open')->count() }}</h2>
                            </div>
                            <div>
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card stat-card info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">In Progress</h4>
                                <h2>{{ \App\Models\Ticket::where('status', 'In Progress')->count() }}</h2>
                            </div>
                            <div>
                                <i class="fas fa-cogs"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card stat-card success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">Resolved</h4>
                                <h2>{{ \App\Models\Ticket::where('status', 'Resolved')->count() }}</h2>
                            </div>
                            <div>
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card quick-actions-card">
                    <div class="card-header">
                        <h5><i class="fas fa-bolt"></i> Aksi Cepat</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-6 col-lg-3">
                                <a href="{{ route('tickets.create') }}" class="btn btn-action primary w-100">
                                    <i class="fas fa-plus"></i>Buat Tiket Baru
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="{{ route('customers.create') }}" class="btn btn-action success w-100">
                                    <i class="fas fa-user-plus"></i>Tambah Pelanggan
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="{{ route('tickets.index') }}" class="btn btn-action info w-100">
                                    <i class="fas fa-list"></i>Lihat Semua Tiket
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="{{ route('customers.index') }}" class="btn btn-action warning w-100">
                                    <i class="fas fa-users"></i>Lihat Pelanggan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Tickets & Chart -->
        <div class="row g-3">
            <div class="col-lg-8">
                <div class="card tickets-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5><i class="fas fa-clock"></i> Tiket Terbaru</h5>
                        <a href="{{ route('tickets.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px; font-weight: 600; font-size: 0.8rem;">
                            Lihat Semua
                        </a>
                    </div>
                    <div class="card-body">
                        @php
                            $recentTickets = \App\Models\Ticket::with('customer')->latest()->limit(5)->get();
                        @endphp
                        @if($recentTickets->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-modern">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Judul</th>
                                            <th>Pelanggan</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentTickets as $ticket)
                                        <tr>
                                            <td><strong style="color: #667eea;">#{{ $ticket->id }}</strong></td>
                                            <td>{{ Str::limit($ticket->title, 30) }}</td>
                                            <td>{{ $ticket->customer->name }}</td>
                                            <td>
                                                <span class="badge badge-modern text-white
                                                    @if($ticket->status == 'Open') warning
                                                    @elseif($ticket->status == 'In Progress') info
                                                    @elseif($ticket->status == 'Resolved') success
                                                    @elseif($ticket->status == 'Closed') secondary
                                                    @endif">
                                                    {{ $ticket->status }}
                                                </span>
                                            </td>
                                            <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada tiket</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card chart-card">
                    <div class="card-header">
                        <h5><i class="fas fa-chart-pie"></i> Status Tiket</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="ticketStatusChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('ticketStatusChart').getContext('2d');
const ticketStatusChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Open', 'In Progress', 'Resolved', 'Closed'],
        datasets: [{
            data: [
                {{ \App\Models\Ticket::where('status', 'Open')->count() }},
                {{ \App\Models\Ticket::where('status', 'In Progress')->count() }},
                {{ \App\Models\Ticket::where('status', 'Resolved')->count() }},
                {{ \App\Models\Ticket::where('status', 'Closed')->count() }}
            ],
            backgroundColor: [
                '#f5576c',
                '#00f2fe',
                '#38f9d7',
                '#7f7f7f'
            ],
            borderWidth: 0,
            hoverOffset: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 15,
                    font: {
                        size: 11,
                        weight: '600'
                    },
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            }
        }
    }
});
</script>
@endsection
