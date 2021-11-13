<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style.css" rel="stylesheet" >
    </head>
    <body>
        <h1>Gerenciador de Ordem de Serviço</h1>

        <?php require 'formulario.php'; ?>

        <?php if($exibir_tabela) : ?>
            <?php require 'tabela.php' ?>
        <?php endif; ?>
                
    </body>
</html>