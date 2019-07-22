<?php

require_once("config.php");

/*
$sql = new sql();

$usuarios = $sql->select("select * from tb_usuarios");

echo json_encode($usuarios);
*/

// Carrega um Usuario 
/*
$root = new Usuario();

$root->loadById(3);

echo $root;
*/

// Carrega uma lista
/*
$list = Usuario::getList();

 echo json_encode($list);
*/

 // Carrega uma lista de usuarios buscado pelo login
/*
$search = Usuario::search("u");

echo json_encode($search);
*/

/*
$usuario = new Usuario();

$usuario->login("igor","doheioid");

echo $usuario;
*/

// Criando novo usuarios
/*
$aluno = new Usuario("Beny","8888");

$aluno->insert();

echo $aluno;
*/

//Actualizado usuario

$usuario = new Usuario();

$usuario->loadById(7);

$usuario->update("Professor","papel");

echo $usuario;


