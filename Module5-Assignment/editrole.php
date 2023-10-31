<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['new_role'])) {
    $usersFile = 'users.txt';
    $emailToEdit = $_POST['email'];
    $newRole = $_POST['new_role'];
    $users = file_exists($usersFile) ? file($usersFile) : [];
    $updatedUsers = [];

    foreach ($users as $user) {
        list($email, $passwordHash, $role, $fullname) = explode(',', trim($user));
        if ($email === $emailToEdit) {
            $updatedUsers[] = $email . "," . $passwordHash . "," . $newRole . "," . $fullname . "\n";
        } else {
            $updatedUsers[] = $user;
        }
    }

    file_put_contents($usersFile, implode('', $updatedUsers));

    $_SESSION['success_message'] = "Role updated successfully.";
    header('Location: admin_dashboard.php');
    exit;
}

$_SESSION['error_message'] = "An error occurred.";
header('Location: admin_dashboard.php');
exit;
?>
