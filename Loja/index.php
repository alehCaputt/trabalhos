<?php
include 'config.php';
session_start();

$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Loja de Produtos</title>
    <link rel="stylesheet" href="style.css">


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
        <h2>Lista de Produtos</h2>
        <table>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['nome']; ?></td>
                <td>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
                <td><?php echo $row['quantidade']; ?></td>
                <td>
                    <a href="edit_product.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="delete_product.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
                    <a href="add_to_cart.php?produto_id=<?php echo $row['id']; ?>">Adicionar ao Carrinho</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
