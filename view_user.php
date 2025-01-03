<?php
require 'db.php';
session_start();

// Redirect to login page if no user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the user ID from the URL
if (isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];
    // Fetch user details
    $sql = "SELECT username, name, email, role, birthday, gender FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if (!$user) {
        // If user is not found, redirect to dashboard with error
        header('Location: dashboard.php?error=User not found.');
        exit();
    }
} else {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            margin-top: 3rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-sm {
            font-size: 0.9rem;
            padding: 0.4rem 0.7rem;
        }

        .alert {
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Main Content -->
    <div class="container">
        <h1 class="mb-4">View User Profile</h1>

        <!-- Feedback Messages -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <!-- Display User Information -->
        <div>
            <h2><?php echo htmlspecialchars($user['username']); ?>'s Profile</h2>
            <ul class="list-group">
                <li class="list-group-item"><strong>Full Name:</strong> <?php echo htmlspecialchars($user['name']); ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></li>
                <li class="list-group-item"><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></li>
                <li class="list-group-item"><strong>Birthday:</strong> <?php echo htmlspecialchars($user['birthday']); ?></li>
                <li class="list-group-item"><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></li>
            </ul>
        </div>

        <div class="mt-3">
            <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
    
    <!-- Include Footer -->
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
