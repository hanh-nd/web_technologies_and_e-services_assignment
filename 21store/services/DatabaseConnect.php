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
            // An error occurred.
            if (!mysqli_select_db($this->db, $name)) {
                exit();
            }
        } else {
            // An error occurred.
            exit();
        }
    }

    function disconnect() {
        mysqli_close($this->db);
    }

    public function setQuery($query){
        $this->query = $query;
    }

    public function executeQuery($singleResult = 0){
        $this->result = mysqli_query($this->db, $this->query);

        if(!$this->result){
            echo "An error occurred when executing query!";
            exit();
        }

        if (preg_match("/select/i", $this->query)) {
            $res = array();
            $table = array();
            $field = array();
            $tempResults = array();
            $numOfFields = 0;
            while ($fieldinfo = mysqli_fetch_field($this->result)) {
                array_push($field, $fieldinfo->name);
                $numOfFields++;
            }

            while ($row = mysqli_fetch_row($this->result)) {
                for ($i = 0; $i < $numOfFields; ++$i) {
                    $field[$i] = $this->snakeToCamel($field[$i]);
                    $tempResults[$field[$i]] = $row[$i];
                }
                if ($singleResult == 1) {
                    mysqli_free_result($this->result);
                    return json_decode(json_encode($tempResults));
                }
                array_push($res, $tempResults);
            }

            mysqli_free_result($this->result);
            $objRes = array();

            foreach ($res as $item) {
                array_push($objRes, json_decode(json_encode($item)));
            }
            return $objRes;
        }
    }

    // public function executeQuery1(){
    //     $result = mysqli_query($this->db, $this->query);

    //     if(!$result){
    //         echo "FAIL when execute!";
    //         exit();
    //     }

    //     return $result;
    // }
    public function updateQuery(){
        $result = mysqli_query($this->db, $this->query);

        if(!$result){
            echo "FAIL when update!";
            exit();
        }

    }

    function snakeToCamel($input) {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
    }

    public function select($id) {
        $this->query = 'SELECT * FROM `' . $this->table . '` WHERE `id` = \'' . mysqli_real_escape_string($this->db, $id) . '\'';
        return $this->executeQuery(1);
    }

    public function selectAll() {
        $this->query = 'SELECT * FROM `' . $this->table . '`';
        return $this->executeQuery();
    }

    public function getTotalRows($query) {
        $this->query = $query;
        $this->result = mysqli_query($this->db, $this->query);
        return mysqli_fetch_row($this->result)[0];
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
