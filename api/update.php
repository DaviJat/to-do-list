<?php
require_once './connection.php';

// Função para atualizar uma tarefa
function updateTarefa($id, $descricao, $conn) {
    // Prepara a consulta SQL com placeholders para evitar ataques de injeção de SQL
    $sql = "UPDATE tarefa SET descricao = ? WHERE id = ?";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração foi bem-sucedida
    if ($stmt) {
        // Associa os valores aos parâmetros da declaração
        $stmt->bind_param("si", $descricao, $id);

        // Executa a declaração
        if ($stmt->execute()) {
            echo "Tarefa atualizada com sucesso.";
        } else {
            echo "Erro ao atualizar tarefa: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo "Erro ao preparar a declaração SQL: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o formulário foi enviado via método POST
    if (isset($_POST['id']) && isset($_POST['descricao'])) {
        $id = $_POST['id'];
        $novaDescricao = $_POST['descricao'];

        // Chama a função para atualizar a tarefa
        updateTarefa($id, $novaDescricao, $conn);
    }
}
?>
