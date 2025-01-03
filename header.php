<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']); // Get the current page name
date_default_timezone_set('Asia/Kuala_Lumpur'); // Set timezone to your local time
$current_date_time = date('l, F j, Y - h:i A'); // Format: Monday, January 1, 2025 - 12:00 PM
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #a8d2ff;
            padding: 1rem;
        }
        .navbar-brand {
            font-size: 1.9rem;
            font-weight: bold;
            color: #333;
        }
        .navbar-brand img {
            height: 80px;
            width: auto;
            margin-right: 10px;
        }
        .navbar-text {
            font-size: 1.2rem;
            color: #555;
        }
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.5rem;
            }
            .navbar-text {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid">
        <!-- Logo and Site Name -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="images/logouitm.png" alt="UiTM Logo"> 
            UiTM Puncak Perdana
        </a>

        <!-- Current Date and Time -->
        <div class="navbar-text ms-auto me-4">
            <?php echo $current_date_time; ?>
        </div>

        <!-- Logout or Login Button -->
        <div class="d-flex align-items-center">
            <?php if (isset($_SESSION['username'])): ?>
                <span class="me-3">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                <a href="logout.php" class="btn btn-danger">
                    <i class="fa-solid fa-sign-out-alt"></i> Logout
                </a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary">
                    <i class="fa-solid fa-sign-in-alt"></i> Login
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
