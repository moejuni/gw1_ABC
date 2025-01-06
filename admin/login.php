<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $host = '127.0.0.1';
    $dbname = 'groepswerk';
    $dbuser = 'root';
    $dbpass = 'root';

    try {
        // Database connection
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute query
        $sql = "SELECT * FROM users WHERE email = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);




        if (!$user) {
            $error = 'User not found. Please check your username.';
        } elseif (($password != $user['password'])) {
            $error = 'Incorrect password. Please try again.';
        } else {
            // Successful login
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id'];
            header('Location: indexadmin.php');
            exit;
        }
    } catch (PDOException $e) {
        // Display database connection error
        $error = "Database error: " . htmlspecialchars($e->getMessage());
    }
}


$pdo = new PDO("mysql:host=127.0.0.1;dbname=groepswerk", 'root', 'root');

$sql = "SELECT * FROM users WHERE email = :username";
$stmt = $pdo->prepare($sql);
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


?>











<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Admin Login</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Email</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>

</html>