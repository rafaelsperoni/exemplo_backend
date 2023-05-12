<?php
session_start();

//chegou da requisição 
$usuario = 'rafael';
$senha = '123';

//consulta
if (($usuario == 'rafael') && ($senha=='123')){
    //se logou, cria sessao de usuario
    $_SESSION['tipo'] = 'C';
    $_SESSION['nome'] = 'Rafael';

}

echo ('<a href="cursos.php">Cursos</a>');