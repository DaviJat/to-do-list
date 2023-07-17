<?php
require_once './connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o formulário foi enviado via método POST
    if (isset($_POST['descricao'])) {
        $descricao = $_POST['descricao'];

        // Chama a função createTarefa
        createTarefa($descricao, $conn);
    }
}

function createTarefa($descricao, $conn) {
    // Prepara a consulta SQL usando prepared statements
    $sql = "INSERT INTO tarefa (descricao) VALUES (?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincula o parâmetro da descrição à consulta SQL
        $stmt->bind_param("s", $descricao);

        // Executa a consulta SQL
        if ($stmt->execute()) {
            echo "Dados inseridos com sucesso.";
        } else {
            echo "Erro ao inserir dados: " . $stmt->error;
        }

        // Fecha o statement
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }
}
?>
