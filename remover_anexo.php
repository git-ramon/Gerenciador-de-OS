<?php
    require 'banco.php';

    $anexo = buscar_anexo($conexao, $_GET['id']);
    remover_anexo($conexao, $anexo['id']);
    unlink('anexo/'.$anexo['arquivo']);
    header('Location:tarefa.php?id='.$anexo['tarefa_id']);
?>