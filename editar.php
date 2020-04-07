<?php
   require "config.php";
   require "dao/UsuarioDaoMysql.php";

    $usuarioDao = new UsuarioDaoMysql($pdo);
    $usuario = false;
    $id = filter_input(INPUT_GET,'id');
    

    if($id){
        $usuario = $usuarioDao->findById($id);
       
    }
   if($usuario === false){
       header("location: index.php");
       exit;
    }


?>


<html>
    <head>
        <title>Index</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    
    </head>
    <body>
        <form method='POST' action='editar_action.php'>
            <div class="form-group">
                <input type='hidden' name='id' value='<?=$usuario->Getid();?>' >
                <label for="name">
                    Nome:
                </label>
                <input type="text" class="form-control" name='name' value='<?=$usuario->GetNome();?>'>
                <br/> <br/>
            </div>
            <div class="form-group">
                <label for="email">
                   Email:
                </label>
                <input type="email" class="form-control" name='email' value='<?=$usuario->GetEmail();?>'>
            </div>
    
            <button type="submit" class="btn btn-primary">SALVAR</button>
        </form>

    </body>