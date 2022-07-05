<?php

class Database{
    private $dbHost = DBHOST;
    private $dbUser = DBUSER;
    private $dbPass = DBPASS;
    private $dbName = DBNAME;

    private $statement;
    private $dbHandler;
    private $error;

    public function __construct()
    {
        $conn = 'mysql:host=' .$this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => TRUE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try{
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //function for preparing queries
    public function query($sql){
        $this->statement = $this->dbHandler->prepare($sql);
    }

    //Allows Us to Bind Values
    public function bind($parameter, $value, $type = null){
        switch (is_null($type)){
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
            $type = PDO::PARAM_STR;
        }   
        $this->statement->bindValue($parameter, $value, $type);
    }

    //allow us to execute statement
    public function execute(){
        return $this->statement->execute();
    }

    //allows us to return array
    public function resultSet(){
        $this->execute();
        return $this->statement->fetchALl(PDO::FETCH_OBJ);
    }

    //returning specific row
    public function single(){
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    //gets us the amout of rows
    public function rowCount(){
        $this->execute();
        return $this->statement->rowCount();
    }

}