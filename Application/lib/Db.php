<?php

namespace application\lib;

use PDO;

class Db {

    protected $db;

    public function __construct() {
        $config = require 'application/config/db.php';
        $this -> db = new PDO('mysql:host='.$config['host']. ';dbname='.$config['name']. '', $config['user'], $config['password']);
    }

    public function query($sql){
        $query = $this->db->query($sql);
        $result = $query->fetchColumn();
        debug($result);
    }
    
}