<?php
require_once "includes/connect.php";
$errors = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);

// Check if the form was submitted
if (!empty($_FILES['image_path']['name'])) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["image_path"]["name"]);
    $targetFile = $targetDir . $fileName;

    move_uploaded_file($_FILES["image_path"]["tmp_name"], $targetFile);
    $image_path = $targetFile;
}

if (empty($errors)) {
    $sql = "INSERT INTO finalDB (image_path, title)
                VALUES (:image_path, :title)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':image_path', $imagePath);
    $stmt->execute();

    $success = "Image Uploaded";
}
