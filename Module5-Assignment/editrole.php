<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Admin') {
    header('Location: home.php');
    exit;
}

// Process the role update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['new_role'])) {
    $usersFile = 'users.txt';
    $emailToEdit = $_POST['email'];
    $newRole = $_POST['new_role'];
    $users = file_exists($usersFile) ? file($usersFile) : [];
    $updatedUsers = [];

    foreach ($users as $user) {
        list($email, $passwordHash, $role, $fullname) = explode(',', trim($user));
        if ($email === $emailToEdit) {
            // Update the role for this user
            $updatedUsers[] = $email . "," . $passwordHash . "," . $newRole . "," . $fullname . "\n";
        } else {
            // Keep other users unchanged
            $updatedUsers[] = $user;
        }
    }

    // Write the updates back to the users file
    file_put_contents($usersFile, implode('', $updatedUsers));

    // Redirect back to admin dashboard
    header('Location: admin_dashboard.php');
    exit;
}

// Redirect back to admin dashboard if the required data isn't present
header('Location: admin_dashboard.php');
exit;
