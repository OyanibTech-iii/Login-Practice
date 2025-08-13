<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Laravel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.1)" points="0,1000 1000,0 1000,1000"/></svg>');
            background-size: cover;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .nav-link {
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: #667eea !important;
        }
        
        .about-section {
            padding: 80px 0;
            background: #f8f9fa;
        }
        
        .mission-section {
            padding: 80px 0;
            background: white;
        }
        
        .team-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
        }
        
        .team-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
            height: 100%;
        }
        
        .team-card:hover {
            transform: translateY(-10px);
        }
        
        .team-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 3rem;
        }
        
        .stats-section {
            padding: 60px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: #ffd700;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .values-section {
            padding: 80px 0;
            background: white;
        }
        
        .value-card {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }
        
        .value-card:hover {
            transform: translateY(-10px);
        }
        
        .value-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }
        
        .cta-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        
        .footer {
            background: #2c3e50;
            color: white;
            padding: 40px 0 20px;
        }
        
        .social-links a {
            color: white;
            font-size: 1.5rem;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        
        .social-links a:hover {
            color: #667eea;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-cube text-primary me-2"></i>
                Laravel App
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link p-0">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 hero-content">
                    <h1 class="hero-title">About Our Company</h1>
                    <p class="hero-subtitle">
                        We're passionate about building secure, scalable, and beautiful web applications 
                        that help businesses grow and succeed in the digital world.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <h2 class="display-4 fw-bold mb-4">Our Story</h2>
                    <p class="lead mb-4">
                        Founded in 2024, we started with a simple mission: to make web development 
                        accessible, secure, and beautiful for everyone.
                    </p>
                    <p class="mb-4">
                        What began as a small team of passionate developers has grown into a 
                        comprehensive web development company that specializes in Laravel applications, 
                        modern UI/UX design, and secure authentication systems.
                    </p>
                    <p class="mb-0">
                        We believe that great software should not only function flawlessly but also 
                        provide an exceptional user experience that delights and inspires.
                    </p>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="position-relative">
                        <i class="fas fa-rocket" style="font-size: 15rem; color: #667eea; opacity: 0.3;"></i>
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <i class="fas fa-code" style="font-size: 5rem; color: #764ba2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 mb-5">
                    <h2 class="display-4 fw-bold mb-3">Our Mission & Vision</h2>
                    <p class="lead text-muted">Driving innovation through technology</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 border-0 shadow-lg">
                        <div class="card-body text-center p-5">
                            <div class="mb-4">
                                <i class="fas fa-bullseye text-primary" style="font-size: 4rem;"></i>
                            </div>
                            <h3 class="card-title mb-3">Our Mission</h3>
                            <p class="card-text">
                                To empower businesses with cutting-edge web applications that are 
                                secure, scalable, and user-friendly. We strive to deliver solutions 
                                that exceed expectations and drive real business value.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 border-0 shadow-lg">
                        <div class="card-body text-center p-5">
                            <div class="mb-4">
                                <i class="fas fa-eye text-success" style="font-size: 4rem;"></i>
                            </div>
                            <h3 class="card-title mb-3">Our Vision</h3>
                            <p class="card-text">
                                To be the leading provider of innovative web solutions that transform 
                                how businesses operate online. We envision a future where technology 
                                seamlessly enhances human productivity and creativity.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Projects Completed</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Happy Clients</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number">5+</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Support Available</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="display-4 fw-bold mb-3">Our Core Values</h2>
                    <p class="lead text-muted">The principles that guide everything we do</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Security First</h4>
                        <p class="text-muted">
                            We prioritize security in every application we build, ensuring 
                            your data and your users' information is always protected.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>User-Centric Design</h4>
                        <p class="text-muted">
                            Every feature and design decision is made with the end user in mind, 
                            creating intuitive and enjoyable experiences.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h4>Innovation</h4>
                        <p class="text-muted">
                            We constantly explore new technologies and approaches to deliver 
                            cutting-edge solutions that give you a competitive advantage.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h4>Partnership</h4>
                        <p class="text-muted">
                            We work closely with our clients, building long-term relationships 
                            based on trust, communication, and mutual success.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h4>Quality</h4>
                        <p class="text-muted">
                            We maintain the highest standards of quality in our code, design, 
                            and project delivery, ensuring reliable and maintainable solutions.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4>Timeliness</h4>
                        <p class="text-muted">
                            We respect deadlines and deliver projects on time, helping you 
                            meet your business objectives and launch schedules.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="display-4 fw-bold mb-3">Meet Our Team</h2>
                    <p class="lead">The talented people behind our success</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="team-card">
                        <div class="team-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h4>John Doe</h4>
                        <p class="text-muted mb-2">CEO & Founder</p>
                        <p class="small">
                            Passionate about technology and business growth. 
                            Leads our company with vision and innovation.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="team-card">
                        <div class="team-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h4>Jane Smith</h4>
                        <p class="text-muted mb-2">Lead Developer</p>
                        <p class="small">
                            Expert in Laravel and modern web technologies. 
                            Crafts elegant and efficient code solutions.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="team-card">
                        <div class="team-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h4>Mike Johnson</h4>
                        <p class="text-muted mb-2">UI/UX Designer</p>
                        <p class="small">
                            Creates beautiful and intuitive user interfaces 
                            that enhance user experience and engagement.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 fw-bold mb-4">Ready to Work Together?</h2>
                    <p class="lead mb-4">
                        Let's discuss how we can help bring your vision to life. 
                        Our team is ready to create something amazing for you.
                    </p>
                    <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5 py-3 me-3">
                        <i class="fas fa-envelope me-2"></i>Get In Touch
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-light btn-lg px-5 py-3">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-cube me-2"></i>Laravel App</h5>
                    <p class="text-muted">
                        Building secure, scalable, and beautiful web applications 
                        with modern technologies and best practices.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="social-links mb-3">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                    <p class="text-muted mb-0">
                        &copy; {{ date('Y') }} Laravel App. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>