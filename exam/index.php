<?php
// Connect to the database
require_once "includes/connect.php";
require_once "includes/auth.php";
// Show the admin-style header/navigation
// Array for validation errors
$errors = [];
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['image_path']) && $_FILES['image_path']['error']  !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['image_path']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "Error With Upload";
        } else { 
            $allowedType = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg']; 
            $detectedType = mime_content_type($_FILES['image_path']['tmp_name']);
            if (!in_array($detectedType, $allowedType, true)) {
                $errors[] = "Invalid File Type";
            } else {
                $extension = pathinfo($_FILES['image_path']['name'], PATHINFO_EXTENSION);
                $safeFilename = uniqid('product_', true) . '.' . strtolower($extension);
                $destination = __DIR__ . '/uploads/' . $safeFilename;
                if (move_uploaded_file($_FILES['image_path']['tmp_name'], $destination)) {
                    $imagePath = 'uploads/' . $safeFilename;
                } else {
                    $errors[] = "Upload Failed";
                }
            }
        }
    }

    if (empty($errors)) {
        $sql = "INSERT INTO finalDB (image_path, title)
                VALUES (:image_path, :title)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':image_path', $imagePath);
        $stmt->execute();

        $success = "Image Uploaded";
    }
}
?>

<main class="container mt-4">
    <h1>Add Profile Picture</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <h3>We Found the Following Errors:</h3>
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data" class="mt-3">
        <label for="image_path" class="form-label">Profile Image</label>
        <input
            type="file"
            id="image_path"
            name="image_path"
            class="form-control mb-4"
            accept=".jpg,.jpeg,.png,.webp">

        <label for="Title" class="form-label">Title</label>
        <input
            type="text"
            id="title"
            name="title"
            class="form-control mb-4"
            required>

        <button type="submit" class="btn btn-primary">Add Image</button>
    </form>
    <p class="mt-4">
            <a href="profile.php">View Images</a>
    </p>
</main>
