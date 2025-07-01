<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin -  Kos GRAHA')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #fdf6ee 0%, #f7e9d2 100%);
            min-height: 100vh;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #b97a56 0%, #f7e9d2 100%);
            color: #fff;
            box-shadow: 2px 0 12px rgba(185,122,86,0.08);
        }
        .sidebar .sidebar-header {
            font-size: 1.5rem;
            font-weight: bold;
            padding: 1.5rem 1rem 1rem 1rem;
            border-bottom: 1px solid #e6c9a8;
            color: #fff;
            letter-spacing: 1px;
        }
        .sidebar .nav-link {
            color: #fff;
            font-weight: 500;
            border-radius: 25px;
            margin: 0.2rem 0.5rem;
            transition: background 0.2s, color 0.2s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #fffaf4;
            color: #b97a56 !important;
        }
        .sidebar .nav-link i {
            width: 22px;
        }
        .content {
            padding: 2rem;
            background: #fffaf4;
            border-radius: 18px;
            box-shadow: 0 2px 10px rgba(185,122,86,0.07);
            margin: 2rem 0;
        }
        .btn-primary, .btn-success {
            border-radius: 25px;
            font-weight: 600;
        }
        .btn-primary {
            background: #b97a56;
            border: none;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: #6d4c1b;
        }
        .form-control:focus {
            border-color: #b97a56;
            box-shadow: 0 0 0 0.2rem rgba(185,122,86,0.15);
        }
        .alert-success {
            background: #f7e9d2;
            color: #6d4c1b;
            border: 1px solid #e6c9a8;
        }
        .alert-danger {
            background: #fff0e6;
            color: #b97a56;
            border: 1px solid #e6c9a8;
        }
        @media (max-width: 991.98px) {
            .sidebar {
                min-height: auto;
            }
            .content {
                margin: 1rem 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar py-0">
            <div class="sidebar-header text-center mb-4">
                <i class="fas fa-user-cog me-2"></i>Admin  Kos GRAHA
            </div>
            <ul class="nav flex-column mb-4">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.rooms.*')) active @endif" href="{{ route('admin.rooms.index') }}">
                        <i class="fas fa-bed me-2"></i>Kamar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.messages.*')) active @endif" href="{{ route('admin.messages.index') }}">
                        <i class="fas fa-envelope me-2"></i>Pesan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.testimonials.*')) active @endif" href="{{ route('admin.testimonials.index') }}">
                        <i class="fas fa-comment-dots me-2"></i>Testimoni
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-start w-100">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
    </body>
</html>
