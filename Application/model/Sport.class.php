<?php


class Sport
{
    private $id = '';
    public $sport_name = '';

    public static function loadAllSports()
    {
        // Returns Array of all Sports

        $sql_connection = new mySqlConnection();
        $sql = "SELECT * FROM sport ORDER BY sport_name ASC";

        $statement = $sql_connection->connect()->prepare($sql);
        $statement->execute();
        $allSports = $statement->fetchAll(PDO::FETCH_UNIQUE);

        return $allSports;
    }

    public static function loadSport(int $sport_id)
    {
        $sql_connection = new mySqlConnection();
        $sql = "SELECT * FROM sport WHERE sport_name = :sport_id";

        $statement = $sql_connection->connect()->prepare($sql);
        $statement->bindValue(":sport_name",$sport_id);
        $statement->execute();
        $sport = $statement->fetch(PDO::FETCH_CLASS,'Sport');

        return $sport;
    }
}