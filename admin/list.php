<?php
include_once "header.inc.php";
include_once "db.inc.php";

// Dynamische sortering
$order = $_GET['order'] ?? 'id';
$allowedOrders = ['id', 'title', 'year', 'location'];
$order = in_array($order, $allowedOrders) ? $order : 'id';

$sort = $_GET['sort'] ?? 'asc';
$sort = strtolower($sort) === 'desc' ? 'desc' : 'asc';

$sql = "SELECT id, title, year, description, location, shdescription, image FROM battles ORDER BY $order $sort";
$stmt = $pdo->query($sql);
$battles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h2 class="text-center text-primary">Lijst van Beroemde Slagen</h2>

    <!-- Dropdown voor sorteren -->
    <form method="GET" action="" class="mb-3">
        <label for="order" class="form-label">Sorteer op:</label>
        <select name="order" id="order" class="form-select w-auto d-inline">
            <option value="id" <?= $order === 'id' ? 'selected' : '' ?>>ID</option>
            <option value="title" <?= $order === 'title' ? 'selected' : '' ?>>Titel</option>
            <option value="year" <?= $order === 'year' ? 'selected' : '' ?>>Jaar</option>
            <option value="location" <?= $order === 'location' ? 'selected' : '' ?>>Locatie</option>
        </select>

        <select name="sort" id="sort" class="form-select w-auto d-inline">
            <option value="asc" <?= $sort === 'asc' ? 'selected' : '' ?>>Oplopend</option>
            <option value="desc" <?= $sort === 'desc' ? 'selected' : '' ?>>Aflopend</option>
        </select>

        <button type="submit" class="btn btn-primary">Toepassen</button>
    </form>

    <!-- Tabel -->
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th><a href="?order=id&sort=<?= $sort === 'asc' ? 'desc' : 'asc' ?>" class="sort-<?= $sort ?>">#</a></th>
                <th>Afbeelding</th>
                <th><a href="?order=title&sort=<?= $sort === 'asc' ? 'desc' : 'asc' ?>" class="sort-<?= $sort ?>">Titel</a></th>
                <th><a href="?order=year&sort=<?= $sort === 'asc' ? 'desc' : 'asc' ?>" class="sort-<?= $sort ?>">Jaar</a></th>
                <th><a href="?order=location&sort=<?= $sort === 'asc' ? 'desc' : 'asc' ?>" class="sort-<?= $sort ?>">Locatie</a></th>
                <th>Korte Beschrijving</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($battles as $battle): ?>
                <tr>
                    <td><?= $battle['id'] ?></td>
                    <td>
                        <?php if (!empty($battle['image'])): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($battle['image']) ?>" alt="<?= htmlspecialchars($battle['title']) ?>" class="img-thumbnail" style="width: 50px; height: 50px;">
                        <?php else: ?>
                            <img src="images/placeholder.jpg" alt="Geen afbeelding beschikbaar" class="img-thumbnail"
                                style="width: 50px; height: 50px;">
                        <?php endif; ?>
                    </td>
                    <td><?= $battle['title'] ?></td>
                    <td><?= $battle['year'] ?></td>
                    <td><?= $battle['location'] ?></td>
                    <td><?= $battle['shdescription'] ?></td>
                    <td>
                        <a href="../detail.php?id=<?= $battle['id'] ?>" class="btn btn-info btn-sm" target="_blank">Bekijk</a>
                        <a href="edit.php?id=<?= $battle['id'] ?>" class="btn btn-warning btn-sm">Bewerk</a>
                        <a href="delete.php?id=<?= $battle['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je dit item wilt verwijderen?');">Verwijder</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
include_once "footer.inc.php";
?>