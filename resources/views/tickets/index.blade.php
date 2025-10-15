@extends('layouts.sidebar')

@section('content')
<style>
    .tickets-wrapper {
        background: transparent;
    }

    .page-header {
        background: white;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        animation: fadeInDown 0.5s ease-out;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-header h3 {
        font-weight: 700;
        color: #2d3748;
        margin: 0;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .page-header h3 i {
        color: #667eea;
    }

    .btn-create {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.25rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        font-size: 0.9rem;
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-create i {
        margin-right: 0.5rem;
    }

    .tickets-card {
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

    .tickets-card .card-body {
        padding: 1.5rem;
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

    /* Filter Section */
    .filter-section {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 10px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .filter-label {
        font-weight: 600;
        color: #4a5568;
        font-size: 0.8rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-select-modern,
    .form-control-modern {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.65rem 1rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: white;
    }

    .form-select-modern:focus,
    .form-control-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .btn-reset {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.65rem 1rem;
        font-weight: 600;
        color: #4a5568;
        transition: all 0.3s ease;
        width: 100%;
        font-size: 0.9rem;
    }

    .btn-reset:hover {
        background: #f8fafc;
        border-color: #cbd5e0;
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    /* Table Styles */
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

    .table-modern tbody tr {
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background: #f8fafc;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .ticket-id {
        color: #667eea;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .ticket-title {
        font-weight: 500;
        color: #2d3748;
    }

    .badge-status {
        padding: 0.4rem 0.85rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .badge-status i {
        font-size: 0.65rem;
    }

    .badge-status.warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .badge-status.info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .badge-status.success {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .badge-status.secondary {
        background: linear-gradient(135deg, #a8a8a8 0%, #7f7f7f 100%);
        color: white;
    }

    .badge-priority {
        padding: 0.4rem 0.85rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-priority.low {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .badge-priority.medium {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }

    .badge-priority.high {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .badge-priority.critical {
        background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
        color: white;
    }

    .btn-detail {
        background: white;
        border: 2px solid #667eea;
        color: #667eea;
        border-radius: 8px;
        padding: 0.4rem 0.85rem;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        text-decoration: none;
    }

    .btn-detail:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-detail i {
        font-size: 0.85rem;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #94a3b8;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 10px;
        margin: 1rem 0;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.3;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-state p {
        font-size: 1.1rem;
        font-weight: 500;
        margin: 0;
        color: #64748b;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .page-header h3 {
            font-size: 1.25rem;
            justify-content: center;
        }

        .btn-create {
            width: 100%;
        }

        .filter-section {
            padding: 1rem;
        }

        .table-modern {
            font-size: 0.8rem;
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 0.75rem 0.5rem;
        }
    }
</style>

<div class="tickets-wrapper">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3>
                <i class="fas fa-ticket-alt"></i>
                Tiket Gangguan
            </h3>
            <a href="{{ route('tickets.create') }}" class="btn btn-create">
                <i class="fas fa-plus"></i>Buat Tiket Baru
            </a>
        </div>

        <!-- Main Card -->
        <div class="card tickets-card">
            <div class="card-body">
                <!-- Alerts -->
                @if(session('success'))
                    <div class="alert alert-success alert-modern alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Filter Section -->
                <div class="filter-section">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="filter-label">Status</label>
                            <select class="form-select form-select-modern" id="statusFilter">
                                <option value="">Semua Status</option>
                                <option value="Open">Open</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Resolved">Resolved</option>
                                <option value="Closed">Closed</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="filter-label">Prioritas</label>
                            <select class="form-select form-select-modern" id="priorityFilter">
                                <option value="">Semua Prioritas</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                                <option value="Critical">Critical</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="filter-label">Pencarian</label>
                            <input type="text" class="form-control form-control-modern" id="searchInput" placeholder="Cari ID, judul, atau pelanggan...">
                        </div>
                        <div class="col-md-2">
                            <label class="filter-label">&nbsp;</label>
                            <button class="btn btn-reset" onclick="resetFilters()">
                                <i class="fas fa-redo"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tickets Table -->
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Pelanggan</th>
                                <th>Status</th>
                                <th>Prioritas</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $ticket)
                            <tr>
                                <td>
                                    <span class="ticket-id">#{{ $ticket->id }}</span>
                                </td>
                                <td>
                                    <span class="ticket-title">{{ $ticket->title }}</span>
                                </td>
                                <td>{{ $ticket->customer->name }}</td>
                                <td>
                                    <span class="badge-status
                                        @if($ticket->status == 'Open') warning
                                        @elseif($ticket->status == 'In Progress') info
                                        @elseif($ticket->status == 'Resolved') success
                                        @elseif($ticket->status == 'Closed') secondary
                                        @endif">
                                        @if($ticket->status == 'Open')
                                            <i class="fas fa-exclamation-circle"></i>
                                        @elseif($ticket->status == 'In Progress')
                                            <i class="fas fa-spinner"></i>
                                        @elseif($ticket->status == 'Resolved')
                                            <i class="fas fa-check-circle"></i>
                                        @elseif($ticket->status == 'Closed')
                                            <i class="fas fa-times-circle"></i>
                                        @endif
                                        {{ $ticket->status }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-priority
                                        @if($ticket->priority == 'Low') low
                                        @elseif($ticket->priority == 'Medium') medium
                                        @elseif($ticket->priority == 'High') high
                                        @elseif($ticket->priority == 'Critical') critical
                                        @endif">
                                        {{ $ticket->priority }}
                                    </span>
                                </td>
                                <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-detail">
                                        <i class="fas fa-eye"></i>Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <p>Tidak ada tiket yang ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(method_exists($tickets, 'links'))
                <div class="d-flex justify-content-center mt-4">
                    {{ $tickets->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function resetFilters() {
    document.getElementById('statusFilter').value = '';
    document.getElementById('priorityFilter').value = '';
    document.getElementById('searchInput').value = '';

    // Trigger filter update if you have filter logic
    filterTickets();
}

// Optional: Add real-time filtering
function filterTickets() {
    const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
    const priorityFilter = document.getElementById('priorityFilter').value.toLowerCase();
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('.table-modern tbody tr');

    rows.forEach(row => {
        if (row.querySelector('.empty-state')) return; // Skip empty state row

        const status = row.cells[3].textContent.trim().toLowerCase();
        const priority = row.cells[4].textContent.trim().toLowerCase();
        const searchText = row.textContent.toLowerCase();

        const statusMatch = !statusFilter || status.includes(statusFilter);
        const priorityMatch = !priorityFilter || priority.includes(priorityFilter);
        const searchMatch = !searchInput || searchText.includes(searchInput);

        if (statusMatch && priorityMatch && searchMatch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Add event listeners for real-time filtering
document.getElementById('statusFilter').addEventListener('change', filterTickets);
document.getElementById('priorityFilter').addEventListener('change', filterTickets);
document.getElementById('searchInput').addEventListener('input', filterTickets);
</script>
@endsection
