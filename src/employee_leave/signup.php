<?php
session_start();
include 'config.php';

$errors = []; 

$email_used = false;
$signup_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_id = $_POST['email_id'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    if ($password != $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM tblaccounts WHERE email_id = :email_id");
            $stmt->execute(['email_id' => $email_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $email_used = true;
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO tblaccounts (first_name, last_name, email_id, password, gender, phone, role) 
                VALUES (:first_name, :last_name, :email_id, :password, :gender, :phone, :role)");
                $stmt->execute([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email_id' => $email_id,
                    'password' => $hashed_password,
                    'gender' => $gender,
                    'phone' => $phone,
                    'role' => $role
                ]);

                $signup_success = true;
            }
        } catch (PDOException $e) {
            $errors[] = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Cedar College Inc. Leave Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background-color: #008000;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #008000;
            border: none;
        }
        .btn-primary:hover {
            background-color: #006600;
        }
        .footer {
            background-color: #008000;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="image/cedar_logo.png" alt="Cedar College Logo" height="40" class="me-2">
                Cedar College
            </a>
        </div>
    </nav>

    <div class="form-container">
        <h2 class="text-center">Sign Up</h2>
        <form action="signup.php" method="POST">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" 
                    value="<?= htmlspecialchars($first_name ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" 
                    value="<?= htmlspecialchars($last_name ?? '') ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" name="role" id="role" required>
                    <option value="">Select Role</option>
                    <option value="1" <?= isset($role) && $role == 1 ? 'selected' : '' ?>>Admin</option>
                    <option value="2" <?= isset($role) && $role == 2 ? 'selected' : '' ?>>Employee</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email_id" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email_id" id="email_id" 
                value="<?= htmlspecialchars($email_id ?? '') ?>" required>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="col-md-6">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <div>
                    <input type="radio" name="gender" value="Male" <?= isset($_POST['gender']) && $_POST['gender'] == 'Male' ? 'checked' : '' ?>> Male
                    <input type="radio" name="gender" value="Female" <?= isset($_POST['gender']) && $_POST['gender'] == 'Female' ? 'checked' : '' ?>> Female
                    <input type="radio" name="gender" value="Other" <?= isset($_POST['gender']) && $_POST['gender'] == 'Other' ? 'checked' : '' ?>> Other
                </div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" name="phone" id="phone" 
                value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>" 
                pattern="[0-9]{11}" placeholder="11 digits only" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2024 Cedar College. All Rights Reserved.</p>
    </div>

    <!-- Sign-Up Success Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Sign Up Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You have signed up successfully!
                </div>
                <div class="modal-footer">
                    <a href="login.php" class="btn btn-primary">OK</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Email Already Used Modal -->
    <div class="modal fade" id="emailUsedModal" tabindex="-1" aria-labelledby="emailUsedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailUsedModalLabel">Email Already Used</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    The email is already being used. Please use a different email.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        <?php if ($email_used): ?>
            var emailUsedModal = new bootstrap.Modal(document.getElementById('emailUsedModal'));
            emailUsedModal.show();
        <?php endif; ?>

        <?php if ($signup_success): ?>
            var signupModal = new bootstrap.Modal(document.getElementById('signupModal'));
            signupModal.show();
        <?php endif; ?>
    </script>
</body>
</html>
