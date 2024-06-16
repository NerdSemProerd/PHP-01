<?php
// Verifica se o parâmetro id foi enviado via GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Inclui o arquivo de conexão
    require_once 'conexao.php';

    // Query para selecionar o usuário com base no id fornecido
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // "i" indica que $id é um inteiro
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verifica se encontrou o usuário
    if ($resultado->num_rows == 1) {
        // Obtém os dados do usuário
        $row = $resultado->fetch_assoc();
        $nome = $row['nome'];
        $email = $row['email'];
        $status = $row['status'];
    } else {
        // Se não encontrou o usuário, redireciona para a página inicial ou exibe uma mensagem de erro
        header("Location: index.php");
        exit();
    }

    // Fecha o statement e a conexão
    $stmt->close();
    $conn->close();
} else {
    // Se o parâmetro id não foi enviado, redireciona para a página inicial ou exibe uma mensagem de erro
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Edição de Usuário</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Formulário de Edição de Usuário</h2>

    <form action="atualizar_usuario.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha">
            <small class="text-muted">Preencha apenas se desejar alterar a senha.</small>
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-select" id="status" name="status">
                <option value="1" <?php if ($status == 1) echo 'selected'; ?>>Ativo</option>
                <option value="0" <?php if ($status == 0) echo 'selected'; ?>>Inativo</option>
            </select>
        </div>
        
        <div class="mb-3 d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Atualizar Usuário</button>
            <a href="index.php" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
