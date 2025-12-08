<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM accounts_tb WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

header("Location: read.php");
exit();
?>
