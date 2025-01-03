<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$user_id = $_GET['id'] ?? $_SESSION['user_id']; // Get the user ID from the URL or session
$sql = "SELECT id, username, name, email, role, birthday, gender FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    echo "User not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .profile-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 2rem auto;
        }

        .profile-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .profile-table th {
            width: 30%;
            text-align: left;
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .profile-table td {
            text-align: left;
        }

        .btn-container {
            margin-top: 1.5rem;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Pills Navigation -->
    <ul class="nav nav-pills nav-justified mb-4">
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="create_user.php">Create User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="profile.php">Profile</a>
        </li>
    </ul>

    <!-- Main Content -->
    <div class="profile-container">
        <h1 class="profile-title">User Profile</h1>

        <table class="table profile-table">
            <tr>
                <th>Username</th>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
            </tr>
            <tr>
                <th>Full Name</th>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
            </tr>
            <tr>
                <th>Role</th>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
            </tr>
            <tr>
                <th>Birthday</th>
                <td><?php echo htmlspecialchars($user['birthday']); ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo htmlspecialchars($user['gender']); ?></td>
            </tr>
        </table>

        <div class="btn-container">
            <a href="edit_profile.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">
                <i class="fa fa-edit"></i> Edit Profile
            </a>
            <a href="dashboard.php" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
