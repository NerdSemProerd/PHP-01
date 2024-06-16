<?php
// Verifica se os dados do formulário foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários foram preenchidos
    if (isset($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['status'])) {
        // Obtém os dados do formulário
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $status = $_POST['status'];

        // Verifica se foi fornecida uma nova senha
        $senha = !empty($_POST['senha']) ? $_POST['senha'] : null;

        // Inclui o arquivo de conexão
        require_once 'conexao.php';

        // Query para atualizar os dados do usuário
        if ($senha !== null) {
            // Se uma nova senha foi fornecida, atualiza incluindo a senha
            $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ?, status = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $nome, $email, $senha, $status, $id);
        } else {
            // Se não foi fornecida nova senha, atualiza sem alterar a senha atual
            $sql = "UPDATE usuarios SET nome = ?, email = ?, status = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssii", $nome, $email, $status, $id);
        }

        // Executa a query
        if ($stmt->execute()) {
            // Redireciona para a página inicial após a atualização
            header("Location: index.php");
        } else {
            // Em caso de erro na execução da query
            echo "Erro ao atualizar o usuário: " . $stmt->error;
        }

        // Fecha o statement e a conexão
        $stmt->close();
        $conn->close();
    } else {
        // Se algum campo necessário não foi preenchido
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
} else {
    // Se os dados não foram enviados via POST
    echo "Método de requisição inválido.";
}
?>
