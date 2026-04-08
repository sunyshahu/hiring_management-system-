<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwiftHire - Hiring Management Solutions</title>
    <!-- Favicon -->
    <link rel="icon" href="images/logo.png" type="image/png">
    <!-- Google Fonts: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-glow: rgba(79, 70, 229, 0.4);
            --dark-bg: #0f172a;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, var(--dark-bg) 0%, #1e1b4b 100%);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 1rem 2rem;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 1px;
            color: #fff !important;
            display: flex;
            align-items: center;
        }
        .navbar-brand img { width: 35px; margin-right: 12px; border-radius: 8px;}

        /* Hero Section */
        .hero {
            flex-grow: 1;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-bg-shapes {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 0; pointer-events: none;
        }
        .shape-1 {
            position: absolute; top: 10%; right: 10%;
            width: 400px; height: 400px;
            background: radial-gradient(circle, var(--primary-glow) 0%, transparent 70%);
            filter: blur(40px);
        }
        .shape-2 {
            position: absolute; bottom: -10%; left: -5%;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.3) 0%, transparent 70%);
            filter: blur(50px);
        }

        .hero-content {
            z-index: 1;
            padding: 4rem 0;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, #fff, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero h1 span {
            background: linear-gradient(to right, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.25rem;
            color: #94a3b8;
            margin-bottom: 2.5rem;
            font-weight: 300;
            max-width: 600px;
        }

        /* Buttons */
        .btn-custom {
            font-size: 1.1rem;
            font-weight: 600;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
        }
        
        .btn-apply {
            background: linear-gradient(135deg, var(--primary), #7c3aed);
            color: white;
            box-shadow: 0 4px 15px var(--primary-glow);
        }
        .btn-apply:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px var(--primary-glow);
            color: white;
        }

        .btn-portal {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
        }
        .btn-portal:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateY(-2px);
        }

        .feature-card {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 3rem;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }
        .feature-card:hover { transform: translateY(-5px); border-color: rgba(129, 140, 248, 0.3); }
        .feature-card i { font-size: 2rem; color: #818cf8; margin-bottom: 1rem; }

    </style>
</head>
<body>

<nav class="navbar navbar-custom float-top w-100">
    <a class="navbar-brand text-decoration-none" href="#">
        <img src="images/logo.png" alt="Logo"> SwiftHire
    </a>
    <div class="d-flex gap-3">
        <a href="login.php" class="btn btn-outline-light px-4 rounded-pill">Log In</a>
        <a href="register.php" class="btn btn-apply px-4">Create Account</a>
    </div>
</nav>

<div class="hero">
    <div class="hero-bg-shapes">
        <div class="shape-1"></div>
        <div class="shape-2"></div>
    </div>
    
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1>Next-Gen <span>Hiring Management</span> System.</h1>
                <p>Welcome to SwiftHire. The fastest, most secure, and visually stunning way to apply for your dream career and track your pipeline.</p>
                <div class="d-flex gap-3">
                    <a href="register.php" class="btn btn-custom btn-apply"><i class="fas fa-rocket me-2"></i>Apply Now</a>
                    <a href="login.php" class="btn btn-custom btn-portal"><i class="fas fa-door-open me-2"></i>Applicant Portal</a>
                </div>
            </div>
            
            <div class="col-lg-5 d-none d-lg-block">
                <div class="row g-4">
                    <div class="col-6">
                        <div class="feature-card">
                            <i class="fas fa-bolt"></i>
                            <h5>Fast Pipeline</h5>
                            <p class="text-secondary small mb-0">Skip the manual labor. Quick apps.</p>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="feature-card">
                            <i class="fas fa-lock"></i>
                            <h5>Secure MDI</h5>
                            <p class="text-secondary small mb-0">Completely secure data containers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
