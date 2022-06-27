<?php

require_once ROOT . DS . 'config' . DS . 'config.php';

class DatabaseConnect {
    private $db;
    private $query;
    protected $result;

    public function __construct() {
        $this->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    public function connect($address, $account, $password, $name) {
        $this->db = @mysqli_connect($address, $account, $password);
        if ($this->db) {
            if (mysqli_select_db($this->db, $name)) {
                echo "Connect database successfully.";
            } else {
                echo "Connect database failed.";
                exit();
            }
        } else {
            echo "Connect database failed.";
            exit();
        }
    }

    function disconnect() {
        if (@mysqli_close($this->db) != 0) {
            echo "An error occurred when disconnecting database.";
        } else {
            echo "Database disconnect successfully.";
        }
    }

    public function setQuery($query){
        $this->query = $query;
    }

    public function executeQuery(){
        $this->result = mysqli_query($this->db, $this->query);

        if(!$this->result){
            echo "An error occurred when executing query!";
            exit();
        }

        return $result;
    }

    public function updateQuery(){
        $this->result = mysqli_query($this->db, $this->query);

        if(!$this->result){
            echo "An error occurred when executing query!";
            exit();
        }

        if (preg_match("/select/i", $query)) {
            $res = array();
            $table = array();
            $field = array();
            $tempResults = array();
            $numOfFields = 0;
            while ($fieldinfo = mysqli_fetch_field($this->result)) {
                array_push($table, $fieldinfo->table);
                array_push($field, $fieldinfo->name);
                $numOfFields++;
            }

            while ($row = mysqli_fetch_row($this->result)) {
                for ($i = 0; $i < $numOfFields; ++$i) {
                    $table[$i] = trim(ucfirst($table[$i]), "s");
                    $tempResults[$table[$i]][$field[$i]] = $row[$i];
                }
                if ($singleResult == 1) {
                    mysqli_free_result($this->result);
                    return $tempResults;
                }
                array_push($res, $tempResults);
            }

            mysqli_free_result($this->result);
            return ($res);
        }
    }

    public function getNumRows() {
        return mysqli_num_rows($this->result);
    }

    public function freeResult() {
        mysqli_free_result($this->result);
    }

    public function getError() {
        return mysqli_error($this->db);
    }

    function __destruct() {
        $this->disconnect();
    }
}
