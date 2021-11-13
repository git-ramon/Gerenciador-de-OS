<?php

//session_start();

// Requer que o arquivo funcione corretamente ou esteja presenta para execução do programa
require 'banco.php'; //Arquivo de conexão com o Banco
require 'ajudantes.php'; //Arquivo de ferramentas

$exibir_tabela = true;
$tem_erros = false;
$erros_validacao = [];

$exibir_tabela = true;

$lista_tarefas = buscar_tarefas($conexao);//Recebe e guarda os resultados de consulta no Banco

if (tem_post()) {
    $tarefa = [
        'nome' => $_POST['nome'],
        'descricao' => 'null',
        'prazo' => 'null',
        'prioridade' => $_POST['prioridade'],
        'concluida' => 0,
    ];

    if (strlen($tarefa['nome']) == 0) {
        $tem_erros = true;
        $erros_validacao['nome'] = 'O Nome da Tarefa é Obrigatorio!';
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
    inserir_tarefa($conexao, $tarefa);
    header('Location: index.php');
    die();
    }
}

$tarefa = [
    'id'        => 0,
    'nome'      => $_POST['nome'] ?? '',
    'descricao' => $_POST['descricao'] ?? '',
    'prazo'     => (isset($_POST['prazo'])) ? traduz_data_para_banco($_POST['prazo']) : '',
    'prioridade'=> $_POST['prioridade'] ?? 1,
    'concluida' => $_POST['concluida'] ?? ''
];

// Include pode avisar sobre ausência ou erro mas não impede a execução do programa
include 'template.php';


?>