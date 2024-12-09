<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include 'config.php';

$email_id = '';
$password = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email_id = trim($_POST['email_id']);
    $password = trim($_POST['password']);

    if (empty($email_id) || empty($password)) {
        $errors[] = "Please enter both email and password.";
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("SELECT id, email_id, password, role FROM tblaccounts WHERE email_id = :email_id LIMIT 1");
            $stmt->execute(['email_id' => $email_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email_id'] = $user['email_id'];
                $_SESSION['role'] = $user['role'];

                if ((int)$user['role'] === 1) { 
                    header("Location: admin/admin_dashboard.php");
                    exit();
                } elseif ((int)$user['role'] === 2) { 
                    header("Location: employee/employee_dashboard.php");
                    exit();
                } else {
                    $errors[] = "Unknown role. Contact the administrator.";
                }
            } else {

                $errors[] = "Invalid email or password.";
            }
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cedar College Inc. Leave Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f9f9f9;
        }
        .navbar {
            background-color: #008000;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .btn-primary {
            background-color: #008000;
            border: none;
        }
        .btn-primary:hover {
            background-color: #006600;
        }
        .card-header {
            background-color: #fddb3a;
            color: #000;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="image/cedar_logo.png" alt="Cedar College Logo" height="40" class="me-2">
                Cedar College Inc.
            </a>
        </div>
    </nav>

    <!-- Login Form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="email_id" class="form-label">Email Address</label>
                                <input type="email" name="email_id" class="form-control" value="<?= htmlspecialchars($email_id) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="forgot_password.php" class="text-decoration-none">Forgot Password?</a>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Error Display -->
                <?php if (!empty($errors)): ?>
                    <div class="mt-3">
                        <?php foreach ($errors as $error): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
