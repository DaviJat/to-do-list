<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o formulário foi enviado via método POST
    if (isset($_POST['adicionar-tarefa'])) {
        $tarefa = $_POST['adicionar-tarefa'];

        // Chama a função adicionarTarefa
        adicionarTarefa($tarefa, $conn);
    }
}

// Obtém todas as tarefas do banco de dados
$tarefas = retornarTarefas($conn);

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./styles.css">
    <title>To-do List</title>
</head>
<body>
    <div class="card">

        <div class="header-container">
            <h1>Minhas tarefas</h1>
        </div>

        <div class="divisor"></div>

        <form method="POST" action="index.php">
            <div class="create-container">
                <label for="adicionar-tarefa" >Adicionar tarefa:</label>
                <div class="input-container">
                    <input type="text" id="adicionar-tarefa" name="adicionar-tarefa" placeholder="Descreva a tarefa...">
                    <button class="add-button" type="submit"><span class="material-symbols-outlined">add</span></button>
                </div>
            </div>
        </form>

        <div class="tarefas-container">
        <div class="divisor"></div>
            <?php if (!empty($tarefas)): ?>
                <ul class="tarefas-lista">
                    <?php foreach ($tarefas as $tarefa): ?>
                        <li class="tarefa">
                            <div>
                                <p id="descricao-<?php echo $tarefa['id']; ?>"><?php echo $tarefa['descricao']; ?></p>
                                <input id="input-descricao-<?php echo $tarefa['id']; ?>" value="<?php echo $tarefa['descricao']; ?>" style="display: none;">
                            </div>
                            <div class="button-list-container">
                                <button id="edit-button-<?php echo $tarefa['id']; ?>" class="edit-button" type="button" onclick="editTarefa(<?php echo $tarefa['id']; ?>)"><span class="material-symbols-outlined">edit</span></button>
                                <button id="exclude-button-<?php echo $tarefa['id']; ?>" class="exclude-button" type="button" onclick="deleteTarefa(<?php echo $tarefa['id']; ?>)"><span class="material-symbols-outlined">delete_forever</span></button>
                                <button id="cancel-button-<?php echo $tarefa['id']; ?>" class="cancel-button" style="display: none;" type="button" onclick="cancelarEditTarefa(<?php echo $tarefa['id']; ?>)"><span class="material-symbols-outlined">close</span></button>
                                <button id="save-button-<?php echo $tarefa['id']; ?>" class="save-button" style="display: none;" type="button" onclick="saveTarefa(<?php echo $tarefa['id']; ?>)"><span class="material-symbols-outlined">save</span></button>
                            </div>
                        </li>
                        <div class="divisor"></div>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Não há tarefas para exibir.</p>
            <?php endif; ?>
        </div>

    </div>
</body>
</html>
<script>
    function editTarefa(id) {
        var descricao = $('#descricao-' + id);
        var input = $('#input-descricao-' + id);
        var edit = $('#edit-button-' + id);
        var exclude = $('#exclude-button-' + id);
        var save = $('#save-button-' + id);
        var cancel = $('#cancel-button-' + id);

        descricao.toggle();
        input.toggle();
        edit.toggle();
        exclude.toggle();
        save.toggle();
        cancel.toggle();
    }
    function cancelarEditTarefa(id) {
        var descricao = $('#descricao-' + id);
        var input = $('#input-descricao-' + id);
        var edit = $('#edit-button-' + id);
        var exclude = $('#exclude-button-' + id);
        var save = $('#save-button-' + id);
        var cancel = $('#cancel-button-' + id);

        descricao.toggle();
        input.toggle();
        edit.toggle();
        exclude.toggle();
        save.toggle();
        cancel.toggle();
    }     

    function saveTarefa(id) {
        var inputElemento = $('#input-descricao-' + id);
        var novaDescricao = inputElemento.val();

        // Verificar se a nova descrição é válida

        // Chamar a função para atualizar a tarefa no banco de dados
        $.ajax({
            url: 'atualizar.php',
            method: 'POST',
            data: {
                id: id,
                descricao: novaDescricao
            },
            success: function(response) {
                // Exibir mensagem de sucesso
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Exibir mensagem de erro
                console.log(error);
            }
        });
    }
</script>