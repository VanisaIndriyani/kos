<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Kos GRAHA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #fdf6ee 0%, #f7e9d2 100%);
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            border: none;
            box-shadow: 0 2px 16px rgba(185,122,86,0.10);
            border-radius: 1.5rem;
            background: linear-gradient(135deg, #fffaf4 60%, #f7e9d2 100%);
        }
        .login-title {
            font-weight: bold;
            color: #b97a56;
            letter-spacing: 1px;
        }
        .form-control:focus {
            border-color: #b97a56;
            box-shadow: 0 0 0 0.2rem rgba(185,122,86,0.15);
        }
        .btn-primary {
            background: #b97a56;
            border: none;
            border-radius: 25px;
            font-weight: 600;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: #6d4c1b;
        }
        .alert-danger {
            background: #fff0e6;
            color: #b97a56;
            border: 1px solid #e6c9a8;
        }
        .text-muted {
            color: #b97a56 !important;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="col-md-5 col-lg-4">
        <div class="card login-card p-4">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="fas fa-house-user fa-3x" style="color:#b97a56;"></i>
                </div>
                <h2 class="login-title mb-4 text-center">
                    <i class="fas fa-user-cog me-2"></i>Login Admin
                </h2>
                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.authenticate') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                    </button>
                </form>
            </div>
        </div>
        <div class="text-center mt-3 text-muted">
            &copy; 2024 Kos GRAHA
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 