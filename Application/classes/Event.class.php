<?php

class Event
{
    private $id = "";
    private $sql_connection;

    public function __construct()
    {
        $this->sql_connection = new mySqlConnection();
    }

    public function save()
    {
        $sql = "INSERT INTO `country` (`id`, `country_name`, `country_code`) VALUES (NULL, 'Österreich', 'AUT')";
        $entry = $this->sql_connection->connect()->prepare($sql);
        $entry->execute();
    }

    public function fetchCountryName()
    {
        $sql = "SELECT country_name FROM country WHERE country_code = 'AUT'";
        $ergebnis = $this->sql_connection->connect()->prepare($sql);
        $ergebnis->execute();

        $string = $ergebnis->fetch();
        echo $string['country_name'];
    }

}