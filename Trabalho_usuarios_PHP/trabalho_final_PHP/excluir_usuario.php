<?php
// Verifica se o parâmetro id foi enviado via GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtém o id do usuário a ser excluído
    $id = $_GET['id'];

    // Inclui o arquivo de conexão
    require_once 'conexao.php';

    // Prepara e executa a query para excluir o usuário
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // "i" indica que $id é um inteiro
    $stmt->execute();

    // Verifica se a exclusão foi bem-sucedida
    if ($stmt->affected_rows > 0) {
        // Redireciona de volta para a página principal após a exclusão
        header("Location: index.php");
    } else {
        // Caso ocorra algum erro na exclusão
        echo "Erro ao tentar excluir o usuário.";
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
} else {
    // Se o parâmetro id não foi enviado, exibe uma mensagem de erro
    echo "ID do usuário não especificado.";
}
?>
