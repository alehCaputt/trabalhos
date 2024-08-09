<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $nome_social = $_POST['nome_social'];
    $usa_nome_social = isset($_POST['usa_nome_social']) ? 1 : 0;
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $telefone = $_POST['telefone'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (email, nome, sobrenome, nome_social, usa_nome_social, endereco, cep, telefone, senha) 
            VALUES ('$email', '$nome', '$sobrenome', '$nome_social', $usa_nome_social, '$endereco', '$cep', '$telefone', '$senha')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function buscaCEP() {
            const cep = document.querySelector('input[name="cep"]').value.replace(/\D/g, '');
            if (cep.length === 8) {
                axios.get(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => {
                    if (!response.data.erro) {
                        document.querySelector('input[name="endereco"]').value = `${response.data.logradouro}, ${response.data.bairro}, ${response.data.localidade} - ${response.data.uf}`;
                    }
                })
                .catch(error => console.error('Erro ao buscar o CEP:', error));
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Usuário</h2>
        <form method="post" action="">
            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>

            <label>Nome:</label><br>
            <input type="text" name="nome" required><br><br>

            <label>Sobrenome:</label><br>
            <input type="text" name="sobrenome" required><br><br>

            <label>Nome Social (opcional):</label><br>
            <input type="text" name="nome_social"><br><br>

            <label>Usar Nome Social?</label>
            <input type="checkbox" name="usa_nome_social"><br><br>

            <label>CEP:</label><br>
            <input type="text" name="cep" onblur="buscaCEP()" required><br><br>

            <label>Endereço:</label><br>
            <input type="text" name="endereco" required><br><br>

            <label>Telefone:</label><br>
            <input type="text" name="telefone" required><br><br>

            <label>Senha:</label><br>
            <input type="password" name="senha" required><br><br>

            <label>Confirmar Senha:</label><br>
            <input type="password" name="confirm_senha" required><br><br>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
