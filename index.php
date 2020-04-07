<?php

    require "config.php";
    require "dao/UsuarioDaoMysql.php";

    $usuarioDao = new UsuarioDaoMysql($pdo);
    $lista = $usuarioDao->findAll();

    

?>

<html>
    <head>
        <title>Index</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    
    </head>
    <body>
        <a href='adicionar.php'> <button type="button" class="btn btn-outline-primary">Adicionar usuário</button> </a>
        <table class="table" >
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">AÇÕES</th>
                </tr>
                <?php foreach($lista as $usuario): ?>
                    <tr>
                        <td><?=$usuario->getId();?> </td>
                        <td><?=$usuario->getNome();?> </td>
                        <td><?=$usuario->getEmail();?></td>
                        <td>
                            <a href='editar.php?id=<?=$usuario->getId();?>'><button type="button" class="btn btn-secondary">EDITAR</button> <a>
                            <a href='excluir.php?id=<?=$usuario->getId();?>'><button type="button" class="btn btn-danger" 
                           onclick="return confirm('Tem certeza que deseja excluir esse usuário ?')">EXCLUIR</button> <a>  
                        </td>


                    </tr>
                <?php endforeach ?>    
            </thead>
            


    </body>




