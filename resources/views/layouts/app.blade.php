<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'ISP Ticket System')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    .navbar-brand {
      font-weight: bold;
    }
    .sidebar {
      min-height: calc(100vh - 56px);
      background-color: #f8f9fa;
    }
    .main-content {
      min-height: calc(100vh - 56px);
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('home') }}">
        <i class="fas fa-ticket-alt"></i> ISP Ticket System
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="fas fa-home"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('tickets.index') }}">
              <i class="fas fa-ticket-alt"></i> Tiket
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('customers.index') }}">
              <i class="fas fa-users"></i> Pelanggan
            </a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <i class="fas fa-user"></i> {{ auth()->user()->name ?? 'User' }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="main-content">
          @yield('content')
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
