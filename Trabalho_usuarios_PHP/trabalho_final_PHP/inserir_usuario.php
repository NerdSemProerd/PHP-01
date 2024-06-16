<?php
// Incluir o arquivo de conexão
require_once 'conexao.php';

// Coletar dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$senha = $_POST['senha']; // Lembre-se de fazer hash da senha antes de armazenar no banco de dados
$status = $_POST['status'];

// Query para inserir um novo usuário
$sql = "INSERT INTO usuarios (nome, email, senha, data_nascimento, status)
            VALUES ('$nome', '$email', '$senha', '$data_nascimento', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "Usuário inserido com sucesso!";
    header("Location: index.php");
} else {
    echo "Erro ao inserir usuário: " . $conn->error;
}

// Fechando conexão com o banco de dados
$conn->close();
?>
