<?php
session_start();


$message = '';


$success_style = "background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;";
$error_style = "background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;";
$warning_style = "background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba;";


if (isset($_POST['loginBtn'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    
    $username = htmlspecialchars(trim($username));

    
    if (isset($_SESSION['username'])) {
        
        if ($_SESSION['username'] !== $username) {
            
            $message = "<div style='padding:10px; border-radius:4px; margin-bottom:15px; {$error_style}'>
                            {$_SESSION['username']} is already logged in. Wait for him to logout first.
                        </div>";
        } else {
            
            $message = "<div style='padding:10px; border-radius:4px; margin-bottom:15px; {$warning_style}'>
                            User {$_SESSION['username']} is already logged in. Please logout first if you wish to re-authenticate.
                        </div>";
        }

    } else {
       
        
        if (empty($username) || empty($password)) {
             $message = "<div style='padding:10px; border-radius:4px; margin-bottom:15px; {$error_style}'>
                            Username and password cannot be empty.
                        </div>";
        } else {
            
            $_SESSION['username'] = $username;
          
            $simulated_hash = password_hash($password, PASSWORD_DEFAULT); 

            $_SESSION['simulated_hash'] = $simulated_hash; 

            $message = "<div style='padding:10px; border-radius:4px; margin-bottom:15px; {$success_style}'>
                            User {$username} logged in successfully!
                        </div>";
            
            
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Session Login</title>
    <style>
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #e9ecef;
            padding: 20px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 25px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box; 
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .login-btn {
            background: #007bff;
            color: white;
            margin-bottom: 20px;
        }
        .login-btn:hover {
            background: #0056b3;
        }
        .logout-btn {
            background: #dc3545;
            color: white;
        }
        .logout-btn:hover {
            background: #c82333;
        }
        label {
            font-weight: 600;
            color: #495057;
        }
        .status-box {
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            font-size: 0.9em;
        }
        .status-user {
            font-weight: 600;
            color: #007bff;
            word-wrap: break-word;
        }
        .status-hash {
            word-wrap: break-word; 
            font-family: monospace;
            font-size: 0.85em;
            color: #495057;
        }
    </style>
</head>
<body>

<div class="container">

<h2>User Login</h2>

<?php

if (isset($message) && $message) {
    echo $message;
}
?>

<form action="" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" name="loginBtn" value="Login" class="login-btn">
</form>

<?php

if (isset($_SESSION['username'])):
?>

<hr style="border: 0; border-top: 1px solid #dee2e6; margin-top: 20px; margin-bottom: 20px;">

<div class="status-box">
    <p>Current Status: Logged in as: <span class="status-user"><?= htmlspecialchars($_SESSION['username']) ?></span></p>
    
    <p>Simulated Hashed Password:</p>
    <p class="status-hash">
        <?php
        
        echo htmlspecialchars($_SESSION['simulated_hash'] ?? 'Hash not stored in session on this request.');
        ?>
    </p>
</div>

<form action="logout.php" method="POST">
    <input type="submit" name="logoutBtn" value="Logout" class="logout-btn">
</form>

<?php
endif;
?>

</div>
</body>

</html>
