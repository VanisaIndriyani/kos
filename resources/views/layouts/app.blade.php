<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Manajemen Kos')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
   
        .navbar, .footer {
            background: #f7e9d2 !important;
            color: #6d4c1b !important;
        }
        .navbar-brand {
            font-weight: bold;
            color: #6d4c1b !important;
        }
        .navbar-nav .nav-link {
            color: #6d4c1b !important;
            font-weight: 500;
        }
        .navbar-nav .nav-link.active, .navbar-nav .nav-link:focus, .navbar-nav .nav-link:hover {
            color: #b97a56 !important;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            background: #fffaf4;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px) scale(1.01);
            box-shadow: 0 6px 24px rgba(185,122,86,0.13);
        }
        .room-image {
            height: 200px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
        }
        .status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }
        .footer {
            background: linear-gradient(90deg, #f7e9d2 60%, #fdf6ee 100%) !important;
            color: #6d4c1b !important;
            padding: 2rem 0;
            margin-top: 3rem;
            border-top: 2px solid #e6c9a8;
        }
        .footer h5 {
            color: #b97a56;
        }
        .footer a, .footer i {
            color: #6d4c1b;
        }
        .whatsapp-btn {
            background-color: #25d366;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(37,211,102,0.08);
        }
        .whatsapp-btn:hover {
            background-color: #128c7e;
            color: white;
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
            background:rgb(14, 215, 71);
            color: #6d4c1b;
            border: 1px solid #e6c9a8;
        }
        .alert-danger {
            background: #fff0e6;
            color: #b97a56;
            border: 1px solid #e6c9a8;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-home me-2"></i> Kos GRAHA
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-list me-1"></i>Daftar Kamar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gallery.index') }}">
                            <i class="fas fa-images me-1"></i>Galeri Kos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('testimonials.index') }}">
                            <i class="fas fa-comment-dots me-1"></i>Testimoni
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">
                            <i class="fas fa-user-cog me-1"></i>Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
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

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-md-6 text-center text-md-start">
                    <h5 class="mb-2" style="font-weight:bold; letter-spacing:1px;">
                        <i class="fas fa-house-user me-2" style="color:#b97a56;"></i> Kos GRAHA
                    </h5>
                    <p class="mb-0">Sistem manajemen kos yang mudah dan efisien untuk pemilik dan calon penyewa.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <h5 class="mb-2" style="font-weight:bold; color:#b97a56;">Kontak</h5>
                    <p class="mb-1">
                        <i class="fas fa-phone me-2"></i><span style="font-weight:500;">+62 123 456 789</span><br>
                        <i class="fas fa-envelope me-2"></i><span style="font-weight:500;">info@kosgraha.com</span>
                    </p>
                </div>
            </div>
            <hr style="border-color:#e6c9a8;">
            <div class="text-center" style="font-size:1rem; color:#b97a56; font-weight:500;">
                <i class="fas fa-copyright me-1"></i>2024 Kos GRAHA. Semua hak dilindungi.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html> 