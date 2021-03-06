<?php
namespace DB;

use \PDO as PDO ;

class Database{
  //properties
  const DB_HOST = '127.0.0.1';
  const DB_NAME = 'testor';
  const DB_USER = 'testor';
  const DB_PASS = 'testor';

  private $host;
  private $dbname;
  private $user;
  private $pass;
  private $pdo;
  private $isConn;

  public function __construct(
    $host = self::DB_HOST,
    $dbname = self::DB_NAME,
    $username = self::DB_USER,
    $password = self::DB_PASS
  ){
    //Init
    $this->host = $host;
    $this->dbname = $dbname;
    $this->user = $username;
    $this->pass = $password;

    //acquire a connection
    try{

$this->pdo = new
PDO("mysql:host={$this->host}
;dbname={$this->dbname}",
$this->user,
$this->pass);

$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(\PDOException $e){
      echo $e->getMessage();
    }
  }
  /**
   * Get all records in a table
   * @param  string $table
   * @return mixed
   */
  //@TODO : Include conditions
  public function getAll(string $table){

      //Get the connection object
      //write the query
      $sql = "SELECT * FROM {$table}";
      $statement = $this->pdo->prepare($sql);
      $statement->execute();
      return $statement;
  }

  //@TODO : Delete based on an id:
  //@TODO Insert a bunch of values to a table
  //@TODO : Update a bunch of values based on a condition
  //@TODO : Parameter binding

  public static function _showDriver(){
    return PDO::getAvailableDrivers();
  }

  public function getById($table,$id,$value){

    try{
        $sql = "SELECT * FROM {$table} WHERE {$id}=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([":id" => $value]);
        return $statement;
    }catch (\PDOException $e){
      $this->pdo->errorInfo();
    }

  }

    public function getConnection(){
        return $this->pdo;
    }


}


?>
