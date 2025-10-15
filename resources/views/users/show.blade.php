@extends('layouts.sidebar')

@section('title', 'Detail User #' . $user->id)

@section('content')
<style>
    .user-detail-wrapper {
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

    .user-card {
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

    .user-card .card-header {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border: none;
        border-bottom: 2px solid #e2e8f0;
        padding: 1.25rem 1.5rem;
        border-radius: 12px 12px 0 0;
    }

    .user-card .card-header h5 {
        font-weight: 700;
        color: #2d3748;
        margin: 0;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .user-card .card-header h5 i {
        color: #667eea;
        font-size: 1rem;
    }

    .user-card .card-body {
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

    .btn-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
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
    }
</style>

<div class="user-detail-wrapper">
    <div class="container-fluid">
        <!-- Detail Header -->
        <div class="detail-header">
            <h2>
                <i class="fas fa-user-shield"></i>
                Detail User #{{ $user->id }}
            </h2>
            <p>Lihat informasi lengkap user</p>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- User Information -->
                <div class="user-card">
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-info-circle"></i>
                            Informasi User
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">ID User</div>
                                    <div class="info-value">#{{ $user->id }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Nama Lengkap</div>
                                    <div class="info-value">{{ $user->name }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Email</div>
                                    <div class="info-value">{{ $user->email }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-user-tag"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Role</div>
                                    <div class="info-value">
                                        <span class="badge-role
                                            @if($user->role === 'Admin') admin
                                            @elseif($user->role === 'CS') cs
                                            @elseif($user->role === 'NOC') noc
                                            @endif">
                                            {{ $user->role }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="user-card">
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-clock"></i>
                            Informasi Waktu
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-calendar-plus"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Dibuat</div>
                                    <div class="info-value">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-calendar-edit"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Diupdate</div>
                                    <div class="info-value">{{ $user->updated_at->format('d/m/Y H:i') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Actions -->
                <div class="user-card">
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-cogs"></i>
                            Aksi
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="action-buttons">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn-action btn-edit">
                                <i class="fas fa-edit"></i>
                                Edit User
                            </a>
                            <a href="{{ route('users.index') }}" class="btn-action btn-back">
                                <i class="fas fa-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Role Description -->
                <div class="user-card">
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-shield-alt"></i>
                            Deskripsi Role
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($user->role === 'Admin')
                            <p style="color: #475569; line-height: 1.6; margin: 0;">
                                <strong>Administrator</strong> memiliki kendali penuh atas sistem, termasuk mengelola semua data, users, dan memantau operasional sistem secara keseluruhan.
                            </p>
                        @elseif($user->role === 'CS')
                            <p style="color: #475569; line-height: 1.6; margin: 0;">
                                <strong>Customer Service</strong> bertanggung jawab untuk mendaftarkan pelanggan baru dan membuat tiket gangguan dari laporan pelanggan.
                            </p>
                        @elseif($user->role === 'NOC')
                            <p style="color: #475569; line-height: 1.6; margin: 0;">
                                <strong>NOC Agent</strong> memproses tiket gangguan, menetapkan prioritas, menugaskan teknisi, dan memperbarui status tiket.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection