<?php
// Start the session
session_start();

// Define a default role for new registrations if not specified
$defaultRole = 'User';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    // In a real application, you might allow admins to create users of different roles
    $role = $defaultRole; 

    // Validate inputs
    if (!$fullname || !$email || !$password || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please provide a valid fullname, email, and password.';
    } else {
        // Check if user already exists
        $userExists = false;
        $usersFile = 'users.txt';
        
        if (file_exists($usersFile)) {
            $users = explode("\n", file_get_contents($usersFile));
            foreach ($users as $user) {
                list($storedEmail, , $storedRole) = explode(',', trim($user));
                if ($email === $storedEmail && $role === $storedRole) {
                    $userExists = true;
                    break;
                }
            }
        }

        if ($userExists) {
            $error_message = 'An account with this email already exists.';
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Save the new user
            $userRecord = "$email,$hashedPassword,$role,$fullname\n";
            file_put_contents($usersFile, $userRecord, FILE_APPEND);

            // Set a success message or redirect to a login page
            $_SESSION['success_message'] = 'Registration successful. Please log in.';
            header('Location: home.php');
            exit;
        }
    }
}

// If there's an error, display it above the signup form
if (!empty($error_message)) {
    echo "<p>Error: $error_message</p>";
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <style>
        <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f7f7;
        }
        .login-form {
            background: white;
            max-width: 300px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-form input[type=text], .login-form input[type=email], .login-form input[type=password] {
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
        .login-form a {
            display: inline-block;
            margin-top: 10px;
        }
    </style>
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Sign Up</h2>
        <form method="post" action="">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="home.php">Login</a></p>
    </div>
</body>
</html>
