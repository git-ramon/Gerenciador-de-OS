<?php
    include 'banco.php';
    include 'ajudantes.php';

    $tem_erros = false;
    $erros_validacao = [];

    if (tem_post()) {
        $tarefa_id = $_POST['tarefa_id'];

    if (!array_key_exists('anexo', $_FILES)){
        $tem_erros = true;
        $erros_validacao['anexo'] = 'Você deve selecionar um arquivo para anexar';
    }else{
        if(tratar_anexo($_FILES['anexo'])){
            $nome = $_FILES['anexo']['name'];
            $anexo = [
                'tarefa_id' => $tarefa_id,
                'nome' => substr($nome, 0, -4),
                'arquivo' => $nome,
            ];
        }else{
            $tem_erros = true;
            $erros_validacao['anexo'] = 'Envie anexos nos formatos ZIP ou PDF';
        }
    }

    if (!$tem_erros) {
        gravar_anexo($conexao, $anexo);
        header('Location: index.php');
        die();
        }
}

    $anexos = buscar_anexos($conexao, $_GET['id']);

    $tarefa = buscar_tarefa($conexao, $_GET['id']);

    include 'templatetarefa.php';
?>