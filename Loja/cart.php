<?php
include 'config.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT carrinho.id, produtos.nome, produtos.preco, carrinho.quantidade 
        FROM carrinho 
        JOIN produtos ON carrinho.produto_id = produtos.id 
        WHERE carrinho.usuario_id = $usuario_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>Loja de Produtos</h1>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="cart.php">Carrinho</a></li>
                    <li><a href="logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container">
        <h2>Meu Carrinho</h2>
        <table>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
            <?php
            $total = 0;
            while($row = $result->fetch_assoc()) {
                $total_item = $row['preco'] * $row['quantidade'];
                $total += $total_item;
            ?>
            <tr>
                <td><?php echo $row['nome']; ?></td>
                <td>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
                <td><?php echo $row['quantidade']; ?></td>
                <td>R$ <?php echo number_format($total_item, 2, ',', '.'); ?></td>
                <td><a href="remove_from_cart.php?id=<?php echo $row['id']; ?>">Remover</a></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3">Total Geral</td>
                <td>R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
                <td></td>
            </tr>
        </table>
    </div>
</body>
</html>
