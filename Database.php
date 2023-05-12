<?php
//classe para a conexão
class Database{
    //atributos que serão usados na conexão
    private $host;
    private $port;
    private $database;
    private $user;
    private $pass;
    //atributo que será usado na conexao
    private $connection;

    //método construtor da classe, estabelece a conexão e atribui um valor ao atributo $connection
    public function __construct($host, $port, $database, $user, $pass){
        $this->host = $host;
        $this->port = $port;
        $this->database = $database;
        $this->user = $user;
        $this->pass = $pass;

        $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database};charset=utf8mb4";
        try {
            $this->connection = new PDO($dsn, $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    //método que, quando chamado, entrega a conexão feita
    public function getConnection() {
        return $this->connection;
    }
}