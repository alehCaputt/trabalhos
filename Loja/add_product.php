<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $sql = "INSERT INTO produtos (nome, preco, quantidade) VALUES ('$nome', '$preco', '$quantidade')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="styles.css">
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
                    <li><a href="add_product.php">Adicionar Produto</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container">
        <h2>Adicionar Novo Produto</h2>
        <form method="post" action="">
            <label>Nome:</label><br>
            <input type="text" name="nome" required><br><br>
            <label>Preço:</label><br>
            <input type="text" name="preco" required><br><br>
            <label>Quantidade:</label><br>
            <input type="text" name="quantidade" required><br><br>
            <button type="submit">Adicionar</button>
        </form>
    </div>
</body>
</html>
