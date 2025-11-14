<?php
session_start();

// Define common styles for messages
$success_style = "background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;";
$error_style = "background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;";
$warning_style = "background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba;";

// Hardcoded hash for consistent display (AS REQUESTED, but DO NOT store real hash in session/display)
$simulated_hash = '$2y$10$x.Xz4zL6D8H3vN9yT2tQJ.1M2P3S4R5Q6W7E8R9T0Y1U2I3O4P5';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Session Status</title>
    <style>
        /* Base styles */
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
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Session Status</h2>

    <?php
    if (isset($_SESSION['username'])) {
        // --- LOGGED IN STATE ---

        // Display conditional messages
        if (isset($_SESSION['just_logged_in']) && $_SESSION['just_logged_in'] === true) {
            echo "<div style='padding:10px; border-radius:4px; margin-bottom:15px; {$success_style}'>
                    User {$_SESSION['username']} logged in successfully!
                  </div>";
            unset($_SESSION['just_logged_in']);
        } else {
            // Note: This message's wording is from your original code, even though it's misleading
            echo "<div style='padding:10px; border-radius:4px; margin-bottom:15px; {$warning_style}'>
                    You are currently logged in as {$_SESSION['username']}.
                  </div>";
        }
        ?>
        
        <hr style="border: 0; border-top: 1px solid #dee2e6; margin-top: 20px; margin-bottom: 20px;">
        
        <div class="status-box">
            <p>Current Status: Logged in as: <span class="status-user"><?= htmlspecialchars($_SESSION['username']) ?></span></p>
            
            <p>Simulated Hashed Password:</p>
            <p class="status-hash"><?= htmlspecialchars($simulated_hash) ?></p>
        </div>

        <!-- Logout Button -->
        <form action="logout.php" method="POST" style="margin-top: 20px;">
            <input type="submit" name="logoutBtn" value="Logout" class="logout-btn">
        </form>

        <?php

    } else {
        ?>

        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" name="loginBtn" value="Login" class="login-btn">
        </form>
        <?php
    }
    ?>

</div>
</body>
</html>