@extends('layouts.sidebar')

@section('content')
<style>
    .customers-wrapper {
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

    .customers-card {
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

    .customers-card .card-body {
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
        margin-bottom: 1.5rem;
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

    .alert-modern i {
        font-size: 1.2rem;
    }

    /* Search Section */
    .search-section {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 10px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .search-label {
        font-weight: 600;
        color: #4a5568;
        font-size: 0.8rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control-modern {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.65rem 1rem;
        padding-left: 2.75rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .search-icon-wrapper {
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1rem;
        pointer-events: none;
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

    /* Stats Cards */
    .stats-mini {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-mini-card {
        flex: 1;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        padding: 1rem;
        color: white;
        text-align: center;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }

    .stat-mini-number {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .stat-mini-label {
        font-size: 0.75rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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

    .customer-id {
        color: #667eea;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .customer-name {
        font-weight: 600;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .customer-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.75rem;
        flex-shrink: 0;
    }

    .customer-email {
        color: #64748b;
        font-size: 0.85rem;
    }

    .customer-phone {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #475569;
    }

    .customer-phone i {
        color: #43e97b;
        font-size: 0.85rem;
    }

    .customer-address {
        color: #64748b;
        font-size: 0.85rem;
    }

    .btn-action {
        border-radius: 10px;
        padding: 0.5rem 0.9rem;
        font-weight: 600;
        font-size: 0.75rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        text-decoration: none;
        border: 2px solid;
        margin-right: 0.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-action i {
        font-size: 0.8rem;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-detail {
        background: white;
        border-color: #667eea;
        color: #667eea;
    }

    .btn-detail:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-edit {
        background: white;
        border-color: #f093fb;
        color: #f093fb;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(240, 147, 251, 0.3);
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

        .search-section {
            padding: 1rem;
        }

        .stats-mini {
            flex-direction: column;
        }

        .table-modern {
            font-size: 0.8rem;
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 0.75rem 0.5rem;
        }

        .customer-name {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-action {
            padding: 0.35rem 0.6rem;
            font-size: 0.7rem;
            margin-bottom: 0.25rem;
        }
    }
</style>

<div class="customers-wrapper">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3>
                <i class="fas fa-users"></i>
                Daftar Pelanggan
            </h3>
            <a href="{{ route('customers.create') }}" class="btn btn-create">
                <i class="fas fa-user-plus"></i>Tambah Pelanggan
            </a>
        </div>

        <!-- Main Card -->
        <div class="card customers-card">
            <div class="card-body">
                <!-- Alert -->
                @if(session('success'))
                    <div class="alert alert-success alert-modern alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Mini Stats -->
                <div class="stats-mini">
                    <div class="stat-mini-card">
                        <div class="stat-mini-number">{{ $customers->count() }}</div>
                        <div class="stat-mini-label">Total Pelanggan</div>
                    </div>
                </div>

                <!-- Search Section -->
                <div class="search-section">
                    <div class="row g-3">
                        <div class="col-md-10">
                            <label class="search-label">Pencarian</label>
                            <div class="search-icon-wrapper">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text"
                                       class="form-control form-control-modern"
                                       id="searchInput"
                                       placeholder="Cari berdasarkan nama, email, telepon, atau alamat...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="search-label">&nbsp;</label>
                            <button class="btn btn-reset" onclick="resetSearch()">
                                <i class="fas fa-redo"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Customers Table -->
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelanggan</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Terdaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $customer)
                            <tr>
                                <td>
                                    <span class="customer-id">#{{ $customer->id }}</span>
                                </td>
                                <td>
                                    <div class="customer-name">
                                        <div class="customer-avatar">
                                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                                        </div>
                                        <span>{{ $customer->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="customer-email">{{ $customer->email }}</span>
                                </td>
                                <td>
                                    <div class="customer-phone">
                                        <i class="fas fa-phone-alt"></i>
                                        <span>{{ $customer->phone }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="customer-address">{{ Str::limit($customer->address, 30) }}</span>
                                </td>
                                <td>{{ $customer->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('customers.show', $customer->id) }}" class="btn-action btn-detail">
                                        <i class="fas fa-eye"></i>Detail
                                    </a>
                                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>Edit
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="fas fa-users"></i>
                                        <p>Tidak ada pelanggan yang ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function resetSearch() {
    document.getElementById('searchInput').value = '';
    searchCustomers();
}

// Real-time search functionality
function searchCustomers() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('.table-modern tbody tr');

    rows.forEach(row => {
        if (row.querySelector('.empty-state')) return; // Skip empty state row

        const searchText = row.textContent.toLowerCase();

        if (searchText.includes(searchInput)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Add event listener for real-time search
document.getElementById('searchInput').addEventListener('input', searchCustomers);
</script>
@endsection
