<?php


class Team
{
    public static function loadAllTeams()
    {
        // Returns Array of all Teams

        $sql_connection = new mySqlConnection();
        $sql = "SELECT * FROM team ORDER BY team_name ASC";

        $statement = $sql_connection->connect()->prepare($sql);
        $statement->execute();
        $allTeams = $statement->fetchAll(PDO::FETCH_UNIQUE);

        return $allTeams;
    }
}