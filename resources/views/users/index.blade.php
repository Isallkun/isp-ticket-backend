@extends('layouts.sidebar')

@section('title', 'Kelola Users')

@section('content')
<style>
    .users-wrapper {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 1.5rem 0;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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

    .users-card {
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

    .users-card .card-body {
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

    .user-id {
        color: #667eea;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .user-name {
        font-weight: 500;
        color: #2d3748;
    }

    .badge-role {
        padding: 0.4rem 0.85rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-role.admin {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .badge-role.cs {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .badge-role.noc {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .btn-action {
        border-radius: 8px;
        padding: 0.4rem 0.85rem;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        text-decoration: none;
        margin-right: 0.5rem;
    }

    .btn-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        color: white;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        border: none;
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #e887f4 0%, #e6465a 100%);
        color: white;
        transform: translateY(-2px);
    }

    .btn-action i {
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

        .table-modern {
            font-size: 0.8rem;
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 0.75rem 0.5rem;
        }
    }
</style>

<div class="users-wrapper">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3>
                <i class="fas fa-user-shield"></i>
                Kelola Users
            </h3>
            <a href="{{ route('users.create') }}" class="btn btn-create">
                <i class="fas fa-plus"></i>Tambah User Baru
            </a>
        </div>

        <!-- Main Card -->
        <div class="card users-card">
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

                <!-- Users Table -->
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>
                                    <span class="user-id">#{{ $user->id }}</span>
                                </td>
                                <td>
                                    <span class="user-name">{{ $user->name }}</span>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge-role
                                        @if($user->role === 'Admin') admin
                                        @elseif($user->role === 'CS') cs
                                        @elseif($user->role === 'NOC') noc
                                        @endif">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>Edit
                                    </a>
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                            <i class="fas fa-trash"></i>Hapus
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-users"></i>
                                        <p>Belum ada user yang ditemukan</p>
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
@endsection