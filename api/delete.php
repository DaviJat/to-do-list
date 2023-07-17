<?php
// Inclui o arquivo de conexão com o banco de dados
require_once './connection.php';

// Função para excluir uma tarefa
function deleteTarefa($id, $conn) {
    // Prepara a consulta SQL
    $sql = "DELETE FROM tarefa WHERE id = $id";

    // Executa a consulta SQL
    if ($conn->query($sql) === TRUE) {
        echo "Tarefa excluída com sucesso.";
    } else {
        echo "Erro ao excluir tarefa: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o formulário foi enviado via método POST
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Chama a função para excluir a tarefa
        deleteTarefa($id, $conn);
    }
}
?>
