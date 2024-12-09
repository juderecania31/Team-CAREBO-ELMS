<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Cedar College Inc. Leave Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>

        body {
            background-color: #f9f9f9; 
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background-color: #008000; 
        }
        .navbar-brand, .nav-link {
            color: #fff !important; 
        }
        .hero-section {
            background-color: #fddb3a; 
            padding: 80px 0;
            text-align: center;
            flex: 1; 
        }
        .hero-section h1 {
            font-size: 3rem;
            color: #008000; 
        }
        .hero-section p {
            font-size: 1.2rem;
            color: #000; 
        }
        .btn-primary {
            background-color: #008000; 
            border: none;
        }
        .btn-primary:hover {
            background-color: #006600; 
        }
        .btn-outline-primary {
            color: #008000;
            border-color: #008000;
        }
        .btn-outline-primary:hover {
            background-color: #008000;
            color: #fff;
        }
        .footer {
            background-color: #008000;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="image/cedar_logo.png" alt="Cedar College Logo" height="60" class="me-2">
                Cedar College Inc.
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1>Welcome to Cedar College Inc. Leave Management System</h1>
            <p>Manage your leave requests easily with our intuitive system.</p>
            <div class="d-flex justify-content-center">
                <a href="login.php" class="btn btn-primary btn-lg mx-2">Login</a>
                <a href="signup.php" class="btn btn-outline-primary btn-lg mx-2">Sign Up</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer mt-auto">
        <p>&copy; 2024 Cedar College. All Rights Reserved.</p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
