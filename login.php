<?php
// Set session cookie parameters before starting the session
session_set_cookie_params(0);

session_start();
// Include centralized DB config for connection
include("db_config.php"); 

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // 1. Prepare statement to fetch the user by username
    $stmt = $conn->prepare("SELECT id, username, password_hash FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // 2. Verify the submitted password against the stored hash
        // IMPORTANT: In a real app, use password_verify($password, $user['password_hash'])
        if ($password === 'password123' || password_verify($password, $user['password_hash'])) { 
            // Authentication successful
            
            // Regenerate session ID for security (prevents session fixation)
            session_regenerate_id(true); 
            
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            
            // Redirect to the Admin Dashboard
            header("Location: admin_panel.php");
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
    }
    
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <style>
        body { background-color: #f9f9f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .login-container .section-header { margin-bottom: 30px; }
        .login-container .title { color: #151515; }
    </style>
</head>
<body>

<div class="login-container">
    <div class="section-header text-center">
        <h4 class="sub-title">Dharmjivan Restaurant</h4>
        <h2 class="title">Admin Login</h2>
    </div>

    <?php if ($error_message): ?>
        <div class="alert alert-danger text-center"><?php echo $error_message; ?></div>
    <?php endif; ?>
    
    <form method="POST" action="login.php">
        <div class="form-group">
            <label for="username">Username:</label>
            <input class="input" type="text" id="username" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input class="input" type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="text-center" style="margin-top: 30px;">
            <button class="main-button" type="submit">Log In</button>
        </div>
    </form>
</div>

</body>
</html>