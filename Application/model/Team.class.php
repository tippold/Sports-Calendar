<?php


class Team
{
    private $id = null;
    public $team_name = null;
    public $team_code = null;
    public $_country_id = null;

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

    public static function loadTeam(int $team_id)
    {
        $sql_connection = new mySqlConnection();
        $sql = "SELECT * FROM team WHERE id = :team_id";

        $statement = $sql_connection->connect()->prepare($sql);
        $statement->bindValue(":team_id",$team_id);
        $statement->execute();
        $team = $statement->fetch(PDO::FETCH_CLASS,'Team');

        return $team;
    }
}