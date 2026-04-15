<?php
require_once "includes/connect.php";
$errors = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
$delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_SPECIAL_CHARS);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$image_path = null;
// Check if the form was submitted
if (empty($delete)) {
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
        $stmt->bindParam(':image_path', $image_path);
        $stmt->bindParam(':title', $title);
        $stmt->execute();

        $success = "Image Uploaded";
    }
} elseif ($delete) {
    # Sql to delete on ID
    $sql = "DELETE FROM resumes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
?>
    <h4>Resume Deleted:</h4>
    <p>ID: <?php echo $id; ?></p>
    <a href="update.php">View Submissions</a>
<?php
    exit;
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
        <a href="profile.php">View Images</a>
        <main class="container mt-4">
        </main>
</body>

</html>