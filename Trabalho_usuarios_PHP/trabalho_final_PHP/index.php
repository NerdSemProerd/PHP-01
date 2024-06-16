<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Usuários</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos adicionais opcionais */
        body {
            padding: 20px;
        }
        .status-ativo {
            color: green;
        }
        .status-inativo {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-3">Lista de Usuários</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="actions">Ações</th> <!-- Coluna para os botões -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir o arquivo de conexão
                require_once 'conexao.php';

                // Query para selecionar todos os registros da tabela usuarios
                $sql = "SELECT id, nome, email, status FROM usuarios";
                $resultado = $conn->query($sql);

                // Verificando se há registros retornados pela consulta
                if ($resultado->num_rows > 0) {
                    // Exibindo os dados de cada registro
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nome"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        // Aplicar classe de cor com base no status
                        echo "<td class='" . ($row["status"] == 1 ? "status-ativo" : "status-inativo") . "'>"; //OPERADOR TERNARIO = Condição ? (se verdadeira) mostra isso : (se não) mostra aquilo
                        echo $row["status"] == 1 ? "Ativo" : "Inativo";
                        echo "</td>";
                        // Coluna de Ações alinhada à direita
                        echo "<td class='actions'>";
                        echo "<a href='editar_usuario.php?id=" . $row["id"] . "' class='btn btn-sm btn-info mr-2'>Editar</a>";
                        echo "<a href='excluir_usuario.php?id=" . $row["id"] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\");'>Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum resultado encontrado.</td></tr>";
                }

                // Fechando conexão com o banco de dados
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container mt-3"> <!-- Nova div container para o botão -->
    <a href="formulario_inserir_usuario.php" class="btn btn-primary">Novo Usuário</a>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
