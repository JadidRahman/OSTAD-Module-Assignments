<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['is_logged_in'])) {
    $dashboard = ($_SESSION['role'] === 'Admin') ? 'admin_dashboard.php' : 'user_dashboard.php';
    header('Location: ' . $dashboard);
    exit;
}

// Define admin credentials
define('ADMIN_EMAIL', 'admin@admin.com');
define('ADMIN_PASSWORD', password_hash('admin123', PASSWORD_DEFAULT)); // Store hashed password

// Determine which form to show
$showAdminLogin = isset($_GET['login']) && $_GET['login'] === 'admin';
$showUserLogin = !$showAdminLogin;

$loginError = '';

// User/Admin login logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Read users from the file
    $usersFile = 'users.txt';
    $users = file_exists($usersFile) ? file($usersFile) : [];

    if ($showAdminLogin) {
        // Admin login logic
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($email === ADMIN_EMAIL && password_verify($password, ADMIN_PASSWORD)) {
            // Admin credentials are correct
            $_SESSION['is_logged_in'] = true;
            $_SESSION['role'] = 'Admin';
            $_SESSION['email'] = $email;
            header('Location: admin_dashboard.php');
            exit;
        } else {
            $loginError = 'Invalid admin credentials.';
        }
    } else {
        // User login logic
        if ($showUserLogin) {
    // User login logic
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Check if user exists and password is correct
    $userFound = false;
    foreach ($users as $user) {
        list($storedEmail, $storedPasswordHash, $role, $fullname) = explode(',', trim($user));
        if ($email === $storedEmail && password_verify($password, $storedPasswordHash)) {
            // User credentials are correct
            $_SESSION['is_logged_in'] = true;
            $_SESSION['role'] = trim($role); // Trim role to remove possible newline characters
            $_SESSION['email'] = $email;
            $_SESSION['fullname'] = trim($fullname); // Trim fullname to remove possible newline characters
            $userFound = true;
            break;
        }
    }
    
    if ($userFound) {
        header('Location: user_dashboard.php');
        exit;
    } else {
        $loginError = 'Invalid email or password.';
    }
}
}
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f7f7;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            color: white;
            padding: 10px 20px;
        }
        .navbar a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .login-form {
            background: white;
            max-width: 300px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-form input[type=email], .login-form input[type=password] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .login-form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: white;
            cursor: pointer;
        }
        .login-form button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <span>Website Name</span>
        <div>
            <a href="?login=admin">Admin Login</a>
            <a href="?login=user">User Login</a>
        </div>
    </div>

    <?php if ($showAdminLogin): ?>
    <div class="container">
        <!-- Admin Login Form -->
        <div class="login-form">
            <h2>Admin Login</h2>
            <form method="post" action="admin_dashboard.php">
                <input type="email" name="email" value="admin@admin.com" readonly>
                <input type="password" name="password" value="admin123" readonly>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($showUserLogin): ?>
    <div class="container">
        <!-- User Login Form -->
        <div class="login-form">
    <h2>User Login</h2>
    <form method="post" action="home.php"> <!-- Update this line -->
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($loginError)): ?>
        <p style="color: red;"><?php echo $loginError; ?></p>
    <?php endif; ?>
    <p>Don't Have An Account Yet? <a href="signup.php">Sign Up</a></p>
</div>
    </div>
    <?php endif; ?>

</body>
</html>