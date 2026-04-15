<?php
//challenge students to create independently initially */ 
require_once "includes/connect.php";
require_once "includes/auth.php";

// Get all products, newest first
$sql = "SELECT * FROM finalDB ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$images = $stmt->fetchAll();
?>

<main class="container mt-4">
    <h1 class="mb-4">Uploaded Images</h1>
    <?php if (empty($images)): ?>
        <p>No images to display.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($images as $image): 
                echo "<p><strong>ID:</strong> " . htmlspecialchars($image['id']) . "</p>";
                echo "<p><strong>Title:</strong> " . htmlspecialchars($image['title']) . "</p>";
                ?>
                <div class="col-md-4 mb-4">
                    <?php if (!empty($image['image_path'])): ?>
                        <img
                            src="<?= htmlspecialchars($image['image_path']); ?>"
                            class="card-img-top">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form method="post" class="mt-3" action = "process.php">
        <label class="form-label mt-3" for="current_position">Current Position</label>
            <input class="form-control" type="text" id="id" name="id">

            <label for= "delete" class="form-label">Delete</label>
            <input type="checkbox" id="delete" name="delete">
            <br>
        <button type="submit" class="btn btn-primary">Delete Image</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-3">Add New Image</a>

</main>