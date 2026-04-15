<?php
require_once "includes/connect.php";
$errors = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
$image_path = null;
// Check if the form was submitted
if (!empty($_FILES['image_path']['name'])) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["image_path"]["name"]);
    $targetFile = $targetDir . $fileName;

    move_uploaded_file($_FILES["image_path"]["tmp_name"], $targetFile);
    $image_path = $targetFile;
}

if (empty($errors)) {
    $sql = "INSERT INTO finalDB (image_path, title) VALUES (:image_path, :title)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':image_path', $imagePath);
    $stmt->bindParam(':title', $title);
    $stmt->execute();

    $success = "Image Uploaded";
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
    <!-- Head for process page -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
    <!-- Thank you conformation message to user -->
        <main class="container mt-4">
            <h2>Information Submitted</h2>
            <p><strong>Thank you for submitting your image</strong></p>
            <main class="container mt-4">
        </main>
    </body>
</html>