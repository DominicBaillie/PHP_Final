<?php
// Connect to the database
require_once "includes/connect.php";
require_once "includes/auth.php";
// Show the admin-style header/navigation
// Array for validation errors
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
