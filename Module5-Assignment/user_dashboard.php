<?php
session_start();


if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header('Location: home.php');
    exit;
}

// Load users data
$usersFile = 'users.txt';
$users = file_exists($usersFile) ? file($usersFile) : [];

$currentUserExists = false;
foreach ($users as $user) {
    list($storedEmail, , ,) = explode(',', trim($user));
    if ($_SESSION['email'] === $storedEmail) {
        $currentUserExists = true;
        break;
    }
}

if (!$currentUserExists) {
   
    $_SESSION = [];
    session_destroy();
    header('Location: home.php');
    exit;
}



$css = <<<CSS
body {
    font-family: Arial, sans-serif;
    background: #f7f7f7;
    margin: 0;
    padding: 20px;
}

.dashboard {
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 40px auto;
    text-align: center;
}

.logout-button {
    padding: 10px 20px;
    background-color: #f44336;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    display: inline-block;
    margin-top: 20px;
}
CSS;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <style><?= $css ?></style>
</head>
<body>

    <div class="dashboard">
        <h1>Welcome, <?= htmlspecialchars($_SESSION['fullname']) ?>!</h1>
        <p>This is your user dashboard.</p>

        <a href="logout.php" class="logout-button">Logout</a>
    </div>

</body>
</html>
