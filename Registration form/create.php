<?php
include 'db.php';

if (isset($_POST['save'])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($newPassword !== $confirmPassword) {
        // Changed to use a query parameter for better alert styling with Bootstrap
        header("Location: create.php?alert=Passwords+do+not+match!");
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // NOTE: This SQL still includes the redundant 'confirmPassword' field
    // to exactly match the logic of your original script.
    $sql = "INSERT INTO accounts_tb (firstName, lastName, username, email, phoneNumber, newPassword, confirmPassword)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$firstName, $lastName, $username, $email, $phoneNumber, $hashedPassword, $hashedPassword]);

    header("Location: read.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Data Analyst Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container bg-light">
    <h2 class="mb-4 text-secondary">Register New Data Analyst</h2>

    <?php if (isset($_GET['alert'])): ?>
        <div class="alert alert-warning" role="alert">
            <?= htmlspecialchars($_GET['alert']) ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="firstName" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="col-md-6">
                <label for="lastName" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="mb-3">
            <label for="phoneNumber" class="form-label">Phone Number:</label>
            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label for="newPassword" class="form-label">New Password:</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
            </div>
        
            <div class="col-md-6">
                <label for="confirmPassword" class="form-label">Confirm Password:</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
            </div>
        </div>

        <button type="submit" name="save" class="btn btn-primary w-100">Create Account</button>
        <a href="read.php" class="btn btn-secondary mt-2 w-100">Cancel / View List</a>
    </form>
</div>

