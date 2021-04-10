<?php
include_once "session.php";
adminOnly();
include_once "database.php";

$id = (int) $_GET['id'];

$query = "DELETE FROM apartmaji WHERE id_apartmaji = ?";
$query = "DELETE FROM slike WHERE id_apartmaji = ?";
$query = "DELETE FROM apartmaji WHERE id_apartmaji = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);



header("Location: apartmaji.php");
die();
?>