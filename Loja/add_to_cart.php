<?php
include 'config.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$produto_id = $_GET['produto_id'];
$quantidade = 1;

$sql = "INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES ($usuario_id, $produto_id, $quantidade)";
$conn->query($sql);

header("Location: cart.php");
?>
