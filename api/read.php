<?php
// Função para ler as tarefas
function readTarefas($conn) {
    // Prepara a consulta SQL
    $sql = "SELECT * FROM tarefa";

    // Executa a consulta SQL
    $result = $conn->query($sql);

    // Verifica se a consulta retornou resultados
    if ($result->num_rows > 0) {
        // Array para armazenar as tarefas
        $tarefas = array();

        // Itera sobre os resultados e armazena as tarefas no array
        while ($row = $result->fetch_assoc()) {
            $tarefas[] = $row;
        }

        // Retorna o array de tarefas
        return $tarefas;
    } else {
        // Caso não haja tarefas, retorna um array vazio
        return array();
    }
}
?>
