<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root"; // Substitua pelo seu usuário do banco de dados
$password = "";     // Substitua pela sua senha do banco de dados
$dbname = "cod_teams"; // Nome do banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Variáveis para armazenar mensagens
$registro_msg = '';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'];
    $nome = $_POST['nome'];

    // Verifica se o UID já existe
    $sql = "SELECT * FROM jogadores WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $registro_msg = "Este UID já está registrado!";
    } else {
        // Insere o novo jogador
        $sql = "INSERT INTO jogadores (uid, nome) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $uid, $nome);

        if ($stmt->execute()) {
            $registro_msg = "Jogador registrado com sucesso!";
        } else {
            $registro_msg = "Erro ao registrar jogador: " . $stmt->error;
        }
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Jogador CODM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #2E2E2E;
            color: #FFD700; /* Dourado */
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h1 {
            margin: 20px 0;
        }
        .button {
            padding: 10px 20px;
            background-color: #FFD700; /* Dourado */
            color: #000; /* Preto */
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #FFC300; /* Um dourado mais claro */
        }
        /* Estilos do pop-up */
        .modal {
            display: none; /* Oculto por padrão */
            position: fixed; /* Fica no lugar */
            z-index: 1; /* Fica em cima */
            left: 0;
            top: 0;
            width: 100%; /* Largura total */
            height: 100%; /* Altura total */
            overflow: auto; /* Adiciona rolagem se necessário */
            background-color: rgba(0,0,0,0.4); /* Cor de fundo com opacidade */
        }
        .modal-content {
            background-color: #2E2E2E;
            margin: 15% auto; /* Centraliza o modal */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Largura */
            color: #FFD700; /* Dourado */
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar Jogador CODM</h1>
        <button class="button" id="openModal">Registrar Novo Jogador</button>
        <p><?php echo $registro_msg; ?></p>
    </div>

    <!-- O Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Registrar Novo Jogador</h2>
            <form action="" method="POST">
                <label for="uid">UID do Jogador:</label>
                <input type="text" id="uid" name="uid" required>

                <label for="nome">Nome do Jogador:</label>
                <input type="text" id="nome" name="nome" required>

                <button type="submit" class="button">Finalizar Registro</button>
            </form>
        </div>
    </div>

    <script>
        // Obter o modal
        var modal = document.getElementById("myModal");

        // Obter o botão que abre o modal
        var btn = document.getElementById("openModal");

        // Obter o elemento <span> que fecha o modal
        var span = document.getElementsByClassName("close")[0];

        // Quando o usuário clica no botão, abre o modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Quando o usuário clica no <span> (x), fecha o modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Quando o usuário clica fora do modal, também fecha
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
