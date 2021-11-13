<?php

$bdServidor = '127.0.0.1'; //Pode ser localhost
$bdUsuario = 'localhost'; //Usuário criado no BD
$bdSenha = ''; //Senha totalmente exposta do BD
$bdBanco = 'tarefas'; //Nome do BD dentro do Servidor

$conexao = mysqli_connect($bdServidor,$bdUsuario,$bdSenha,$bdBanco);

if(mysqli_connect_errno()){ //Função retorna se houve algum erro, caso sim, exibe o erro e encerra a execução do sistema
    echo 'Problemas para conectar no banco. Erro:';
    echo mysqli_connect_error(); //Exibe qual foi o erro
    die(); //Encerra a execução do sistema
}

function buscar_tarefas($conexao){
    $sqlBusca = 'SELECT * FROM table_tarefas'; //Consulta SQL
    $resultado = mysqli_query($conexao,$sqlBusca); // Função que executa a requisição 

    $tarefas = []; //Array vazio para receber os resultados

    while($tarefa = mysqli_fetch_assoc($resultado)){ //Função que vai passar os resultados para o Array
        $tarefas[] = $tarefa; 
    }

    return $tarefas; //Retorna o Array com os resultados
}

function inserir_tarefa($conexao, $tarefa){
    if($tarefa['prazo'] == ''){
        $prazo = 'null';
    }else{
        $prazo = "'{$tarefa['prazo']}'";
    }

    $sqlInserir = "INSERT INTO table_tarefas
        (nome, descricao, prioridade, prazo, concluida)
        VALUES
        (
            '{$tarefa['nome']}',
            '{$tarefa['descricao']}',
            {$tarefa['prioridade']},
            {$prazo},
            {$tarefa['concluida']}
        )
    ";
    
    mysqli_query($conexao,$sqlInserir);
}

function buscar_tarefa_para_editar($conexao,$id){

    $sqlBusca = 'SELECT * FROM table_tarefas WHERE id = ' .$id;

    $resultado = mysqli_query($conexao,$sqlBusca);

    return mysqli_fetch_assoc($resultado);    
}

function editar_tarefa($conexao, $tarefa){
    if($tarefa['prazo'] == ''){
        $prazo = 'null';
    }else{
        $prazo = "'{$tarefa['prazo']}'";
    }

    $sqlBusca = "UPDATE table_tarefas SET
                    nome = '{$tarefa['nome']}',
                    descricao = '{$tarefa['descricao']}',
                    prioridade = {$tarefa['prioridade']},
                    prazo = {$prazo},
                    concluida = {$tarefa['concluida']}
                    WHERE id = {$tarefa['id']}";

    mysqli_query($conexao,$sqlBusca);

}

function remover_tarefa($conexao, $id){
    $sqlDelete = "DELETE FROM table_tarefas WHERE id = {$id}";

    mysqli_query($conexao,$sqlDelete);
}

function gravar_anexo($conexao, $anexo){
    $sqlgravar = "INSERT INTO anexos
    (tarefa_id, nome, arquivo) 
    VALUES 
    (
    '{$anexo['tarefa_id']}',
    '{$anexo['nome']}',
    '{$anexo['arquivo']}'
    )
    ";

    mysqli_query($conexao, $sqlgravar);
}

/* Busca Varios Anexos */ 
function buscar_anexos($conexao, $id){
   $sqlBusca = 'SELECT * FROM anexos WHERE tarefa_id = ' .$id;
   $resultado = mysqli_query($conexao, $sqlBusca);

   $anexos = [];

   while ($anexo = mysqli_fetch_assoc($resultado)) {
       $anexos[] = $anexo;
   }

   return $anexos;
}

/* Busca apenas um Anexo */ 
function buscar_anexo($conexao,$id){
    $sqlBusca = 'SELECT * FROM anexos WHERE id = '.$id;
    $resultado = mysqli_query($conexao,$sqlBusca);

    return mysqli_fetch_assoc($resultado);
    }

function buscar_tarefa($conexao, $id){

    $sqlBusca = "SELECT * FROM table_tarefas WHERE id = {$id}";
    
    $busca = mysqli_query($conexao,$sqlBusca);

    return mysqli_fetch_assoc($busca);
}

function remover_anexo($conexao,$id){
    $sqlBusca =
    "DELETE FROM anexos WHERE id = {$id}";
    mysqli_query($conexao,$sqlBusca);
    }

?>