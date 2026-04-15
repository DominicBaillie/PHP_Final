<?php
session_start();

// Prevent standard browser/proxy caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");


// access the current session & check to see whether the user is logged in

if (empty($_SESSION["user_id"])) {
    ?>
    <html lang="en">

<body>
    <main class="container restricted text-center">
        <h1> Sorry, you must be logged into view this content! </h1>
        <a href="login.php" class="btn btn-primary"> Back to Home Page </a>
    </main>
</body>

</html>
<?php
}
    exit();
//require auth.php on all pages that are restricted to registered users only 