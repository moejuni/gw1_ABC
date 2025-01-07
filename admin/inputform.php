<?php
include_once "header.inc.php";
?>

<div class="container mt-5">
    <h2 class="text-center text-primary">Nieuwe Item</h2>
    <form action="processform.php" method="POST" enctype="multipart/form-data" class="mt-4">
        <div class="mb-3">
            <label for="title" class="form-label">Titel Van De Battle:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Vul hier in" required>
        </div>
        <div class="mb-3">
            <label for="short_desc" class="form-label">Verkorte Tekst Voor De Battle:</label>
            <input type="text" class="form-control" id="short_desc" name="short_desc" placeholder="Vul hier in" required>
        </div>
        <div class="mb-3">
            <label for="long_desc" class="form-label">Lange Tekst:</label>
            <textarea class="form-control" id="long_desc" name="long_desc" rows="4" placeholder="Typ je Tekst" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Battle Afbeelding:</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success">Verzenden</button>
    </form>
</div>

<?php
include_once "footer.inc.php";
?>