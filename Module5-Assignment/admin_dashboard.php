<?php
session_start();

// Redirect non-admin users to the home page
if ($_SESSION['role'] !== 'Admin') {
    header('Location: home.php');
    exit;
}

// Read users and roles from the files
$usersFile = 'users.txt';
$rolesFile = 'roles.txt';
$users = file_exists($usersFile) ? file($usersFile) : [];
$roles = file_exists($rolesFile) ? file($rolesFile) : [];

// Handle delete request
if (isset($_GET['delete'])) {
    $emailToDelete = filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_EMAIL);

    // Additional validation can be done here
    if (!empty($emailToDelete)) {
        // Filter out the user to delete
        $users = array_filter($users, function ($user) use ($emailToDelete) {
            list($email) = explode(',', $user);
            return trim($email) !== $emailToDelete;
        });

        // Save the updated list back to the file
        file_put_contents($usersFile, implode("", $users));
        
        // Set a success message
        $_SESSION['success_message'] = "User deleted successfully.";

        // Refresh the page to update the user list
        header('Location: admin_dashboard.php');
        exit;
    } else {
        // Set an error message
        $_SESSION['error_message'] = "Invalid user email.";
    }
}

// Adding a new role
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['new_role'])) {
    $newRole = trim($_POST['new_role']);
    if (!in_array($newRole, $roles)) {
        file_put_contents($rolesFile, $newRole . "\n", FILE_APPEND);
        $roles[] = $newRole;
    }
}

// CSS and HTML below
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .table-users {
            margin: 50px auto;
            width: 80%;
            border-collapse: collapse;
        }
        .table-users th, .table-users td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table-users th {
            background-color: #333;
            color: white;
        }
        .table-users tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .action-button {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .edit-button {
            background-color: #FFA500;
            color: white;
        }
        .delete-button {
            background-color: #FF6347;
            color: white;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Admin Dashboard</h2>
    <!-- Form for adding new roles -->
    <div style="text-align: center; margin-bottom: 20px;">
        <form method="post" action="admin_dashboard.php">
            <input type="text" name="new_role" placeholder="New Role" required>
            <button type="submit">Add Role</button>
        </form>
    </div>


    <table class="table-users">
        <thead>
            <tr>
                <th>Email</th>
                <th>Role</th>
                <th>Full Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <?php list($email, $passwordHash, $role, $fullname) = explode(',', trim($user)); ?>
                <tr>
                    <td><?= htmlspecialchars($email) ?></td>
                    <td><?= htmlspecialchars($role) ?></td>
                    <td><?= htmlspecialchars($fullname) ?></td>
                    <td>
                        <form action="editrole.php" method="post">
                            <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
                            <select name="new_role">
                                <?php foreach ($roles as $availableRole): ?>
                                    <option value="<?= trim($availableRole) ?>" <?= $role == trim($availableRole) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars(trim($availableRole)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="action-button edit-button">Edit Role</button>
                        </form>
                        <form action="admin_dashboard.php" method="get">
                            <input type="hidden" name="delete" value="<?= htmlspecialchars($email) ?>">
                            <button type="submit" class="action-button delete-button" onclick="return confirm('Are you sure you want to delete this user?');">Delete User</button>
                        </form>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
    

</body>
</html>
