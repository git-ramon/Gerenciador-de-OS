<?php

function verifica_prioridade($numPrioridade){
    $prioridade = '';
    switch ($numPrioridade) {
        case 2:
            $prioridade = 'Média';
            break;
        case 3:
            $prioridade = 'Alta';
            break;
        default:
            $prioridade = 'Baixa';
            break;
    }

    return $prioridade;

}

function traduz_data_para_banco($data){
    if($data == ''){
        return '';
    }
/*
    $objeto_data = DateTime::createFromFormat('d/m/Y',$data);

    return $objeto_data->format('Y-m-d');
*/
    
    $dados = explode("/", $data);

    if (count($dados) != 3) {
        return $data;
    }

    $data_banco = "{$dados[2]}-{$dados[1]}-{$dados[0]}";

    return $data_banco;
    

}

function traduz_data_para_exibir($data){
    if($data == '' OR $data == '0000-00-00'){
        return '';
    }
/*
    $objeto_data = DateTime::createFromFormat('Y-m-d', $data);

    return $objeto_data->format('d/m/Y');
*/
    $dados = explode("-",$data);

    if (count($dados) != 3) {
        return $data;
    }

    $data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";

    return $data_exibir;
    
}

function verifica_concluida($concluida){

    if($concluida == 0 OR $concluida == ''){

        return 'Não';
    }

    return 'Sim';
}

function tem_post(){
    if (count($_POST) > 0) {
        return true;
    }
    return false;
}

function validar_data($data){
    $expressao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
    $resultado = preg_match($expressao, $data);

    if ($resultado == 0) {
        return false;
    }

    $dados = explode('/', $data);
    $dia = $dados[0];
    $mes = $dados[1];
    $ano = $dados[2];

    return checkdate($mes, $dia, $ano);
}

function tratar_anexo($anexo){
    $padrao = '/^.+(\.pdf|\.zip)$/'; //Regex validando o tipo de arquivo
    $resultado = preg_match($padrao, $anexo['name']);

    if ($resultado == 0) {
        return false;
    }
    move_uploaded_file($anexo['tmp_name'], "anexo/{$anexo['name']}");
    
    return true;
}

?>