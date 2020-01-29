<?php

require_once('config.inc.php');

class mySqlConnection
{
    private $db;

    function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PW);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            echo $e;
            echo "Verbindung fehlgeschlagen";
            die();
        }
    }

    public function connect()
    {
        return $this->db;
    }
}