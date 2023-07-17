<?php
// Configurações do banco de dados
$servername = "localhost"; // Nome do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "to-do-list"; // Nome do banco de dados

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Operações com o banco de dados

function adicionarTarefa($descricao, $conn) {
    // Prepara a consulta SQL
    $sql = "INSERT INTO tarefa (descricao) VALUES ('$descricao')";

    // Executa a consulta SQL
    if ($conn->query($sql) === TRUE) {
        echo "Dados inseridos com sucesso.";
    } else {
        echo "Erro ao inserir dados: " . $conn->error;
    }
}

// Função para obter todas as tarefas
function retornarTarefas($conn) {
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
