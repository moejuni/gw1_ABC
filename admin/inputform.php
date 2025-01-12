<?php
include_once "header.inc.php";
?>

<div class="container mt-5">
    <h2 class="text-center text-primary">Nieuwe Battle Toevoegen</h2>
    <form action="processform.php" method="POST" enctype="multipart/form-data" class="mt-4">
        <div class="mb-3">
            <label for="title" class="form-label">Titel:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Titel van de battle" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Jaar:</label>
            <input type="text" class="form-control" id="year" name="year" placeholder="Bijv. -480 of 1066" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Locatie:</label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Bijv. Marathon, Greece" required>
        </div>
        <div class="mb-3">
            <label for="shdescription" class="form-label">Korte Beschrijving:</label>
            <input type="text" class="form-control" id="shdescription" name="shdescription" placeholder="Korte beschrijving" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Lange Beschrijving:</label>
            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Gedetailleerde beschrijving" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Afbeelding:</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success">Verzenden</button>
    </form>
</div>

<?php
include_once "footer.inc.php";
?>