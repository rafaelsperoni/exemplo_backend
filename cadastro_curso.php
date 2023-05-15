<?php
/*
Esse script PHP roda no BackEnd.
Recebe os dados enviados via POST.
Estabelece a conexão com o BD.
Monta o SQL insert e atribui os valores enviados.
Executa a consulta
Retorna a mensagem de sucesso ou de erro
*/

//altera o cabecalho da resposta, indicando q é JSON e não HTML
header('Content-type: application/json');
//permite CORS - requisição de outra origem
header("Access-Control-Allow-Origin: *");

//pega os dados enviados do fetch POST (do frontend)
$dados = $_POST; //$dados é um array

require_once 'config.php';
require_once "Database.php";

$sql = "insert into curso (nome, semestres, id_coordenador) values (:nome, :semestres, :coordenador)";

//utiliza as constantes criadas no config.php para uma instância da conexão
$connection = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS);
// Chama o método para obter a conexão PDO. A variável $pdo guarda a conexão
$pdo = $connection->getConnection();
//prepara
$stmt = $pdo->prepare($sql);
//atribui os valores ao SQL
$stmt->bindValue(':nome', $dados['nome']);
$stmt->bindValue(':semestres', $dados['semestres']);
$stmt->bindValue(':coordenador', $dados['coordenador']);
try{
    $stmt->execute();
    $msg['mensagem'] = 'Curso inserido com sucesso.';
}catch(PDOException $e){
    $msg['mensagem'] = 'Erro na inserção: '.$e->getMessage();
}

print(json_encode($msg));