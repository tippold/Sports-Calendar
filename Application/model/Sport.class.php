<?php


class Sport
{
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
}