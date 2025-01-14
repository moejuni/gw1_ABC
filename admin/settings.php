<?php
include_once "header.inc.php";
include_once "db.inc.php";


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    try {
        // Haal de huidige gebruiker op uit de database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $_SESSION['admin_email'], PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Controleer of het huidige wachtwoord correct is
        if (!$user || $currentPassword !== $user['password']) {
            $error = 'Het huidige wachtwoord is onjuist.';
        } elseif ($newPassword !== $confirmPassword) {
            $error = 'De nieuwe wachtwoorden komen niet overeen.';
        } elseif (strlen($newPassword) < 6) {
            $error = 'Het wachtwoord moet minimaal 6 tekens lang zijn.';
        } else {
            // Werk gebruikersnaam en wachtwoord bij
            $stmt = $pdo->prepare("UPDATE users SET email = :email, password = :password WHERE id = :id");
            $stmt->execute([
                ':email' => $newUsername,
                ':password' => $newPassword,
                ':id' => $user['id']
            ]);

            // Werk de sessie bij
            $_SESSION['admin_email'] = $newUsername;
            $success = 'Je gegevens zijn succesvol bijgewerkt.';
        }
    } catch (PDOException $e) {
        $error = 'Er is een fout opgetreden bij het bijwerken van je gegevens.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instellingen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Accountinstellingen</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <!-- Gebruikersnaam wijzigen -->
            <div class="mb-3">
                <label for="username" class="form-label">Nieuwe Gebruikersnaam (E-mail)</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($_SESSION['admin_email']) ?>" required>
            </div>

            <!-- Huidig wachtwoord -->
            <div class="mb-3">
                <label for="current_password" class="form-label">Huidig Wachtwoord</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
            </div>

            <!-- Nieuw wachtwoord -->
            <div class="mb-3">
                <label for="new_password" class="form-label">Nieuw Wachtwoord</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>

            <!-- Bevestig nieuw wachtwoord -->
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Bevestig Nieuw Wachtwoord</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>

            <!-- Verzendknop -->
            <button type="submit" class="btn btn-primary w-100">Gegevens Bijwerken</button>
        </form>
    </div>
</body>

</html>
<?php
include_once "footer.inc.php";
?>