<?php
include 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $sql = "UPDATE produtos SET nome='$nome', preco='$preco', quantidade='$quantidade' WHERE id=$id";

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
    <title>Editar Produto</title>
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
        <h2>Editar Produto</h2>
        <form method="post" action="">
            <label>Nome:</label><br>
            <input type="text" name="nome" value="<?php echo $row['nome']; ?>" required><br><br>
            <label>Preço:</label><br>
            <input type="text" name="preco" value="<?php echo $row['preco']; ?>" required><br><br>
            <label>Quantidade:</label><br>
            <input type="text" name="quantidade" value="<?php echo $row['quantidade']; ?>" required><br><br>
            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>
</html>
