<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Gerenciador de Ordem de Serviço</title>
</head>
<body>
<table id="tabela_template">
    <tr>
        <th>Serviços</th>
        <th>Descrição</th>
        <th>Prazo</th>
        <th>Prioridade</th>
        <th>Concluído</th>
        <th>Opções</th>
    </tr>
    <?php foreach ($lista_tarefas as $tarefas) : ?>
        <tr>
            <td>
                <a href="tarefa.php?id=<?php echo $tarefas['id']; ?>">
                    <?php echo $tarefas['nome'] ?>
                </a>
            </td>
            <td><?php echo $tarefas['descricao'] ?></td>
            <td><?php echo traduz_data_para_exibir($tarefas['prazo']); ?></td>
            <td><?php echo verifica_prioridade($tarefas['prioridade']); ?></td>
            <td><?php echo verifica_concluida($tarefas['concluida']); ?></td>
            
            <td>
                <a href="editar.php?id=<?php echo $tarefas['id']; ?>"> <i><img src="img\pencil-square.svg" alt=""></i> Editar</a>
                <a href="remover.php?id=<?php echo $tarefas['id']; ?>"> <i><img src="img\trash-fill.svg" alt=""></i> Apagar</a>
            </td>
        </tr>
    <?php endforeach ?>
</table>
</body>
</html>