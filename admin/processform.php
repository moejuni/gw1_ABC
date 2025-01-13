<?php
include_once 'db.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Insert the user into the database
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':username' => $username, ':password' => $hashedPassword]);
            echo "User registered successfully!";
            header('Location: login.php');
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Unique constraint violation
                echo "Username already exists. Please choose another.";
            } else {
                echo "Registration failed: " . $e->getMessage();
            }
        }
    } else {
        echo "Please fill out all fields.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
</body>

</html>