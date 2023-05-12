<?php
session_start();
//altera os cabeçalhos
header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");

require_once 'config.php';
require_once "Database.php";


//teste pelo tipo de usuario
//if (isset($_SESSION['tipo']) && ($_SESSION['tipo'] == 'C')){ //pode ver
    //utiliza as constantes criadas no config.php para uma instância da conexão
    $connection = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS);

    // Chama o método para obter a conexão PDO. A variável $pdo guarda a conexão
    $pdo = $connection->getConnection();

    //$_GET - pega o ?id=1 na URL
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        //consulta que será executada
        $sql = "select * from curso where id=:id";
        //preparação
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
    }else{
        //consulta que será executada
        $sql = "select id, nome from curso";
        //preparação
        $stmt = $pdo->prepare($sql);
    }

    //execução da consulta
    $stmt->execute();
    //obtem o resultset da consulta executada e transforma em um array associativo
    $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //exibe o conteúdo do array - normalmente, não queremos esse formato
    //print('<pre>');
    //print_r($cursos);

    //converte o array para JSON
    $cursos_json = json_encode($cursos);

    //exibe os dados em JSON
    print($cursos_json);


    // }else{ //não pode ver
//     $msg = ['erro' => 'Acesso negado'];
//     echo json_encode($msg);
// }

