<?php
    require 'config.php';
    require "dao/UsuarioDaoMysql.php";

    $usuarioDao = new UsuarioDaoMysql($pdo);

    $id= filter_input(INPUT_POST,'id');
    $nome = filter_input(INPUT_POST,'name');
    $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);

    if($nome && $email){

        $usuario = $usuarioDao->findById($id);
        $usuario->setNome($name);
        $usuario->setEmail($email);

        $usuarioDao->update($usuario);

        $sql = $pdo->prepare("UPDATE usuarios SET nome = :nome , email = :email WHERE id=:id ");
        $sql->bindValue(':nome',$nome);
        $sql->bindValue(':email',$email);
        $sql->bindValue(':id',$id);
        $sql->execute();

        header("location: index.php");
        exit;

    }
    else{
        header("location: adicionar.php?=.$id");
        exit;
    }



?>