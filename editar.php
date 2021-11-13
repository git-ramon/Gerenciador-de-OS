<?php

//session_start();

// Requer que o arquivo funcione corretamente ou esteja presenta para execução do programa
require 'banco.php'; //Arquivo de conexão com o Banco
require 'ajudantes.php'; //Arquivo de ferramentas

$exibir_tabela = false;
$tem_erros = false;
$erros_validacao = [];

if (tem_post()) {
    $tarefa = [
        'id' => $_POST['id'],
        'nome' => $_POST['nome'],
        'descricao' => 'null',
        'prazo' => 'null',
        'prioridade' => $_POST['prioridade'],
        'concluida' => 0,
    ];

    if (strlen($tarefa['nome']) == 0) {
        $tem_erros = true;
        $erros_validacao['nome'] = 'O nome do Serviço é Obrigatorio';
    }

    if (array_key_exists('descricao', $_POST)) {
        $tarefa['descricao'] = $_POST['descricao'];
    }

    if (array_key_exists('prazo', $_POST) && strlen($_POST['prazo']) > 0) {
        if (validar_data($_POST['prazo'])) {
            $tarefa['prazo'] = traduz_data_para_banco($_POST['prazo']);
        }else{
            $tem_erros = true;
            $erros_validacao['prazo'] = 'A Data precisa ter o formato Dia/Mês/Ano';
        }
       
    }

    if (array_key_exists('concluida', $_POST)) {
        $tarefa['concluida'] = 1;
    }

    if (!$tem_erros) {
        editar_tarefa($conexao, $tarefa);
        header('Location: index.php');
        die();
    }
        
}

$tarefa = buscar_tarefa_para_editar($conexao, $_GET['id']);

$tarefa['nome'] = (array_key_exists('nome', $_POST)) ? $_POST['nome'] : $tarefa['nome'];
$tarefa['descricao'] = (array_key_exists('descricao', $_POST)) ? $_POST['descricao'] : $tarefa['descricao'];
$tarefa['prazo'] = (array_key_exists('prazo', $_POST)) ? $_POST['prazo'] : $tarefa['prazo'];
$tarefa['prioridade'] = (array_key_exists('prioridade', $_POST)) ? $_POST['prioridade'] : $tarefa['prioridade'];
$tarefa['concluida'] = (array_key_exists('concluida', $_POST)) ? $_POST['concluida'] : $tarefa['concluida'];

// Include pode avisar sobre ausência ou erro mas não impede a execução do programa
include 'template.php';


?>