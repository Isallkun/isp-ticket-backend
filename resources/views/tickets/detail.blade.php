@extends('layouts.sidebar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Detail Tiket #{{ $ticket->id }}</h3>
                    <div>
                        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <!-- Ticket Information -->
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Informasi Tiket</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Judul</h6>
                                            <p class="text-muted">{{ $ticket->title }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Status</h6>
                                            <span class="badge
                                                @if($ticket->status == 'Open') bg-warning
                                                @elseif($ticket->status == 'In Progress') bg-info
                                                @elseif($ticket->status == 'Resolved') bg-success
                                                @elseif($ticket->status == 'Closed') bg-secondary
                                                @endif fs-6">
                                                {{ $ticket->status }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Prioritas</h6>
                                            <span class="badge
                                                @if($ticket->priority == 'Low') bg-success
                                                @elseif($ticket->priority == 'Medium') bg-warning
                                                @elseif($ticket->priority == 'High') bg-danger
                                                @elseif($ticket->priority == 'Critical') bg-dark
                                                @endif fs-6">
                                                {{ $ticket->priority }}
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Kategori</h6>
                                            <p class="text-muted">{{ $ticket->category ?? 'Tidak ditentukan' }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h6>Deskripsi</h6>
                                            <p class="text-muted">{{ $ticket->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Informasi Pelanggan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Nama</h6>
                                            <p class="text-muted">{{ $ticket->customer->name }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Telepon</h6>
                                            <p class="text-muted">{{ $ticket->customer->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Email</h6>
                                            <p class="text-muted">{{ $ticket->customer->email }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Alamat</h6>
                                            <p class="text-muted">{{ $ticket->customer->address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Update & Timeline -->
                        <div class="col-md-4">
                            <!-- Status Update -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Update Status</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-3">
                                            <select class="form-select" name="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
                                                <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="Resolved" {{ $ticket->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                                <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-sync"></i> Update Status
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Ticket Info -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Informasi Tiket</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <strong>ID Tiket:</strong> #{{ $ticket->id }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Dibuat:</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Diupdate:</strong> {{ $ticket->updated_at->format('d/m/Y H:i') }}
                                    </div>
                                    @if($ticket->assigned_to)
                                    <div class="mb-2">
                                        <strong>Ditugaskan ke:</strong> Agent {{ $ticket->assigned_to }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Timeline Perubahan Status</h5>
                                </div>
                                <div class="card-body">
                                    @if($ticket->logs->count() > 0)
                                        <div class="timeline">
                                            @foreach($ticket->logs->sortByDesc('created_at') as $log)
                                            <div class="timeline-item">
                                                <div class="timeline-marker
                                                    @if($log->status == 'Open') bg-warning
                                                    @elseif($log->status == 'In Progress') bg-info
                                                    @elseif($log->status == 'Resolved') bg-success
                                                    @elseif($log->status == 'Closed') bg-secondary
                                                    @endif">
                                                </div>
                                                <div class="timeline-content">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h6 class="mb-1">Status berubah ke: {{ $log->status }}</h6>
                                                            <p class="text-muted mb-1">
                                                                Oleh: {{ $log->user->name ?? 'System' }}
                                                            </p>
                                                        </div>
                                                        <small class="text-muted">{{ $log->created_at->format('d/m/Y H:i') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted text-center">Belum ada perubahan status</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -30px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #dee2e6;
}

.timeline-content {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 3px solid #dee2e6;
}
</style>
@endsection
