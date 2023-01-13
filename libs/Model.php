<?php

class Model{
    
    protected $connect;
    protected $database;
    protected $table;
    protected $resultQuery;
    
    //-----------CONSTRUCT-------------
    public function __construct($params = null)
    {
        if($params == null){
            $params['server']       = DB_HOST;
            $params['username']     = DB_USER;
            $params['password']     = DB_PASS;
            $params['database']     = DB_NAME;
            $params['table']        = DB_TABLE;
        }
        
        $link = mysqli_connect($params['server'], $params['username'], $params['password']);
        
        if (!$link) {
            die('connect fail');
        } else {
            $this->connect  = $link;
            $this->database = $params['database'];
            $this->table    = $params['table'];
            $this->setDatabase();
        }
    }
    
    // SET CONNECT
    public function setConnect($connect)
    {
        $this->connect = $connect;
    }
    
    // SET DATABASE
    public function setDatabase($database = NULL)
    {
        if ($database != null) {
            $this->database = $database;
        }
        mysqli_select_db($this->connect, $this->database);
    }
    
    // SET TABLE
    public function setTable($table)
    {
        $this->table = $table;
    }
    
    // INSERT
    public function insert($data, $type = 'single')
    {
        
        if ($type == 'single') {
            $newQuery   = $this->createInsertSQL($data);
            $query      = "INSERT INTO `$this->table`(" . $newQuery['cols'] . ") VALUES (" . $newQuery['vals'] . ")";
            $this->query($query);
        } else {
            foreach ($data as $value) {
                $newQuery   = $this->createInsertSQL($value);
                $query      = "INSERT INTO `$this->table`(" . $newQuery['cols'] . ") VALUES (" . $newQuery['vals'] . ")";
                $this->query($query);
            }
        }
        return $this->firstID();
    }
    
    // CREATE INSERT SQL
    public function createInsertSQL($data)
    {
        $newQuery = array();
        $cols = '';
        $vals = '';
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $cols .= ", `$key`";
                $vals .= ", '$value'";
            }
        }
        $newQuery['cols'] = substr($cols, 2);
        $newQuery['vals'] = substr($vals, 2);
        return $newQuery;
    }
    
    // UPDATE
    public function update($data, $where)
    {
        $newSet     = $this->createUpdateSQL($data);
        $newWhere   = $this->createWhereUpdateSQL($where);
        $query = "UPDATE `$this->table` SET " . $newSet . " WHERE $newWhere";
        $this->query($query);
        return $this->affectedRows();
    }
    
    
    // CREATE UPDATE SQL
    public function createUpdateSQL($data)
    {
        
        $newQuery = "";
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $newQuery .= ", `$key` = '$value'";
            }
        }
        $newQuery = substr($newQuery, 2);
        return $newQuery;
    }
    
    // CREATE WHERE UPDATE SQL
    public function createWhereUpdateSQL($where)
    {
        $newWhere = [];
        if (!empty($where)) {
            $i = 0;
            foreach ($where as $value) {
                
                $newWhere[] = "`$value[0]` = '$value[1]'";
                if (!empty($value[2])) {
                    $newWhere[] = $value[2];
                }
            }
            $newWhere = implode(" ", $newWhere);
        }
        $newWhere;
        return $newWhere;
    }
    
    // QUERY
    public function query($query)
    {
        $this->resultQuery = mysqli_query($this->connect, $query);
        return $this->resultQuery;
    }
    
    // FIRSTID
    public function firstID()
    {
        return mysqli_insert_id($this->connect);
    }
    
    // LAST ID
    public function lastID(){
        return mysqli_insert_id($this->connect);
    }
    
    // AFFECTED ROWS
    public function affectedRows()
    {
        return mysqli_affected_rows($this->connect);
    }
    
    // DELETE
    public function delete($where)
    {
        $newWhere 	= $this->createWhereDeleteSQL($where);
        $query 		= "DELETE FROM `$this->table` WHERE `id` IN ($newWhere)";
        $this->query($query);
        return $this->affectedRows();
    }
    
    // CREATE WHERE DELTE SQL
    public function createWhereDeleteSQL($data)
    {
        $newWhere = '';
        if(!empty($data)){
            foreach($data as $id) {
                $newWhere .= "'" . $id . "', ";
            }
            $newWhere .= "'0'";
        }
        return $newWhere;
    }

    public function listRecord($query){
        $result = array();
        if(!empty($query)){
            $resultQuery = $this->query($query);
            if(mysqli_num_rows($resultQuery) > 0){
                while($row = mysqli_fetch_assoc($resultQuery)){
                    $result[] = $row;
                }
                mysqli_free_result($resultQuery);
            }
        }
        return $result;
    }
    
    
    // SINGLE RECORD
    public function singleRecord($query)
    {
        $result = array();
        if(!empty($query)){
            $resultQuery = $this->query($query);
            if(mysqli_num_rows($resultQuery) > 0){
                $result = mysqli_fetch_assoc($resultQuery);
            }
            mysqli_free_result($resultQuery);
        }
        return $result;
    }
    
    // TOTAL ITEM
    public function totalItem($resultQuery = null)
    {
        $resultQuery = ($resultQuery == null) ? $this->resultQuery : $resultQuery;
        if (mysqli_num_rows($resultQuery) > 0) {
            $result = mysqli_fetch_assoc($resultQuery);
        }
        mysqli_free_result($resultQuery);
        return $result['totalItems'];

    }
    
    
    public function isExist($query){
        if($query != null) {
            $this->resultQuery = $this->query($query);
        }
        if(mysqli_num_rows($this->resultQuery ) > 0) return true;
        return false;
    }
    
    
    //------------- DISCONNECT DATABASE--------------
    public function __destruct()
    {
        if($this->connect){
            mysqli_close($this->connect);
        }
    }
        
}