<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Laravel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .welcome-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            margin-bottom: 2rem;
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-logout {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
            color: white;
        }
        .user-avatar {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-cube text-primary me-2"></i>
                Laravel App
            </a>
            
            <div class="navbar-nav ms-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-2"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item btn-logout w-100">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Welcome Section -->
        <div class="welcome-section text-center">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <h1 class="display-4 fw-bold mb-3">Welcome back, {{ Auth::user()->name }}!</h1>
            <p class="lead mb-0">You're successfully logged in to your dashboard.</p>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-chart-line fa-3x mb-3"></i>
                        <h3 class="card-title">Analytics</h3>
                        <p class="card-text">View your performance metrics</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-tasks fa-3x mb-3"></i>
                        <h3 class="card-title">Tasks</h3>
                        <p class="card-text">Manage your daily tasks</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <h3 class="card-title">Team</h3>
                        <p class="card-text">Collaborate with your team</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Info Card -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-user me-2"></i>User Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Name:</div>
                            <div class="col-sm-8">{{ Auth::user()->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Email:</div>
                            <div class="col-sm-8">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Member Since:</div>
                            <div class="col-sm-8">{{ Auth::user()->created_at->format('F j, Y') }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 fw-bold">Last Login:</div>
                            <div class="col-sm-8">{{ now()->format('F j, Y g:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-shield-alt me-2"></i>Security</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Your account is secure and protected with Laravel's built-in security features.
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-key me-2"></i>Change Password
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-bell me-2"></i>Notification Settings
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <a href="#" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-plus me-2"></i>New Project
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="#" class="btn btn-outline-success w-100">
                                    <i class="fas fa-upload me-2"></i>Upload File
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="#" class="btn btn-outline-info w-100">
                                    <i class="fas fa-calendar me-2"></i>Schedule
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="#" class="btn btn-outline-warning w-100">
                                    <i class="fas fa-cog me-2"></i>Settings
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
