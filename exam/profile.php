<?php
//challenge students to create independently initially */ 
require "includes/connect.php";

// Get all products, newest first
$sql = "SELECT * FROM finalDB ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$images = $stmt->fetchAll();
?>

?>

<main class="container mt-4">
    <h1 class="mb-4">Uploaded Images</h1>
    <?php if (empty($images)): ?>
        <p>No images to display.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($images as $image): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <?php if (!empty($image['image_path'])): ?>
                            <img
                                src="<?= htmlspecialchars($image['image_path']); ?>"
                                class="card-img-top"
                            >
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</main>
