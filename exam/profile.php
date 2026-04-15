<?php
// Requires/ 
require_once "includes/connect.php";
require_once "includes/auth.php";

// Get all images from databse
$sql = "SELECT * FROM finalDB ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$images = $stmt->fetchAll();
?>

// If no images, well show no images message
<main class="container mt-4">
    <h1 class="mb-4">Uploaded Images</h1>
    <?php if (empty($images)): ?>
        <p>No images to display.</p>
    <?php else: ?>
        // for each image post the id and title
        <div class="row">
            <?php foreach ($images as $image): 
                echo "<p><strong>ID:</strong> " . htmlspecialchars($image['id']) . "</p>";
                echo "<p><strong>Title:</strong> " . htmlspecialchars($image['title']) . "</p>";
                ?>
                <div class="col-md-4 mb-4">
                    <?php if (!empty($image['image_path'])):
                        // Use path to display image from folder
                        ?>
                        <img
                            src="<?= htmlspecialchars($image['image_path']); ?>"
                            class="card-img-top">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; 
    // Form for delting, send id and checkbox verif
    ?>
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