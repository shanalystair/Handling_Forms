<?php
include 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: read.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM accounts_tb WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    header("Location: read.php");
    exit();
}

if (isset($_POST['update'])) {

    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phoneNumber = htmlspecialchars(trim($_POST['phoneNumber']));
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
        
        header("Location: update.php?id=" . $id . "&alert=Passwords+do+not+match!");
        exit();
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $update = "UPDATE accounts_tb 
               SET firstName=?, lastName=?, username=?, email=?, phoneNumber=?, newPassword=?, confirmPassword=? 
               WHERE id=?";

    try {
        $stmt = $conn->prepare($update);
        $stmt->execute([$firstName, $lastName, $username, $email, $phoneNumber, $hashedPassword, $hashedPassword, $id]);

        header("Location: read.php?success=Account+updated+successfully");
        exit();
    } catch (PDOException $e) {
        
        header("Location: update.php?id=" . $id . "&alert=Database+error:+Could+not+update+account.");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Analyst Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);}
    </style>
</head>
<body>

<div class="container bg-light">
    <h2 class="mb-4 text-warning">Edit Data Analyst Account (ID: <?= $id ?>)</h2>

    <?php if (isset($_GET['alert'])): ?>
        <div class="alert alert-warning" role="alert">
            <?= htmlspecialchars($_GET['alert']) ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="firstName" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?= htmlspecialchars($row['firstName']) ?>" required>
            </div>
            <div class="col-md-6">
                <label for="lastName" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?= htmlspecialchars($row['lastName']) ?>" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($row['username']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="phoneNumber" class="form-label">Phone Number:</label>
            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?= htmlspecialchars($row['phoneNumber']) ?>" required>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label for="newPassword" class="form-label">New Password:</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password (required for update)" required>
            </div>
            <div class="col-md-6">
                <label for="confirmPassword" class="form-label">Confirm Password:</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password" required>
            </div>
        </div>

        <button type="submit" name="update" class="btn btn-warning w-100 text-white">Update Account</button>
        <a href="read.php" class="btn btn-secondary mt-2 w-100">Cancel / Go Back</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
