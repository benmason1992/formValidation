<?php

class Dbh {
    private $host;
    private $user;
    private $pwd;
    private $dbName;

    public function connect() {
        $this->host = 'localhost';
        $this->user = 'root';
        $this->pwd = '';
        $this->dbName = 'technicaldb';

        $conn = new mysqli($this->host, $this->user, $this->pwd, $this->dbName);

        return $conn;
    }

}