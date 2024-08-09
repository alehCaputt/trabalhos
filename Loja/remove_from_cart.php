<?php
include 'config.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$sql = "DELETE FROM carrinho WHERE id = $id";
$conn->query($sql);

header("Location: cart.php");
?>
