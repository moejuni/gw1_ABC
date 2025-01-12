<?php
include_once "header.inc.php";
include_once "db.inc.php";

// Uncomment deze regels als je sessiecontrole nodig hebt:
// session_start();
// if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
//     header('Location: login.php');
//     exit;
// }

$totalBattles = getTotalBattles();
$latestBattle = getLatestBattle();
$recentActivities = getRecentActivities();
?>

<div class="container mt-3 text-end">
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Welkomstbericht -->
        <div class="col-md-12 text-center mb-4">
            <h1 class="text-primary">Welkom in het Admin Dashboard</h1>
            <p class="text-muted">Beheer je gegevens eenvoudig en efficiënt met onze krachtige tools.</p>
        </div>
    </div>

    <div class="row">
        <!-- Statistieken Overzicht -->
        <div class="col-lg-3">
            <div class="card text-center shadow mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title m-0">Totaal Items</h5>
                </div>
                <div class="card-body">
                    <h1 class="display-4"><?= $totalBattles ?></h1>
                    <p class="card-text">Items in het systeem</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card text-center shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title m-0">Laatste Toevoeging</h5>
                </div>
                <div class="card-body">
                    <?php if ($latestBattle): ?>
                        <h6 class="card-title"><?= htmlspecialchars($latestBattle['title']) ?></h6>
                        <p class="card-text"><?= htmlspecialchars($latestBattle['year']) ?>, <?= htmlspecialchars($latestBattle['location']) ?></p>
                    <?php else: ?>
                        <p class="card-text">Nog geen items toegevoegd</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card text-center shadow mb-4">
                <div class="card-header bg-warning text-white">
                    <h5 class="card-title m-0">Actieve Gebruikers</h5>
                </div>
                <div class="card-body">
                    <h1 class="display-4">12</h1>
                    <p class="card-text">Ingelogde admins</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card text-center shadow mb-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title m-0">Systeemstatus</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-title">Alles werkt perfect</h6>
                    <p class="card-text">Geen fouten gedetecteerd</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Acties Kaarten -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title m-0">Nieuwe Item</h4>
                </div>
                <div class="card-body text-center">
                    <p class="card-text">Klik hieronder om een nieuw item toe te voegen.</p>
                    <a href="inputform.php" class="btn btn-primary btn-lg w-100">Nieuwe Item Toevoegen</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h4 class="card-title m-0">Overzicht Data</h4>
                </div>
                <div class="card-body text-center">
                    <p class="card-text">Bekijk en beheer alle ingevoerde gegevens.</p>
                    <a href="list.php" class="btn btn-info btn-lg w-100">Bekijk Data</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-warning text-white">
                    <h4 class="card-title m-0">Instellingen</h4>
                </div>
                <div class="card-body text-center">
                    <p class="card-text">Beheer je accountinstellingen en voorkeuren.</p>
                    <a href="settings.php" class="btn btn-warning btn-lg w-100">Instellingen</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Laatste Activiteiten -->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h4 class="card-title m-0">Laatste Activiteiten</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($recentActivities as $activity): ?>
                            <li class="list-group-item"><?= htmlspecialchars($activity['action']) ?> - <?= htmlspecialchars($activity['details']) ?></li>
                        <?php endforeach; ?>
                        <?php if (empty($recentActivities)): ?>
                            <li class="list-group-item">Geen recente activiteiten</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once "footer.inc.php";
?>