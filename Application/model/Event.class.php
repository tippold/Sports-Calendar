<?php

class Event extends mySqlConnection
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

    public static function loadEventsByMonth($year, $month)
    {
        $enddate = "'". date('Y-m-d', mktime(0,0,0,$month + 1,0,$year) ) . "'";
        $startdate = "'" . date('Y-m-d', mktime(0,0,0,$month,1,$year) ) . "'";

        $sql_connection = new mySqlConnection();
        $sql = 'SELECT event.id, event.date, start_time, team1.team_name AS home_team_name, team1.team_code AS home_team_code, team2.team_name AS away_team_name, team2.team_code AS away_team_code
                FROM event 
                JOIN sport ON event._sport_id = sport.id
                JOIN team AS team1 ON event._hometeam_id = team1.id
                JOIN team AS team2 ON event._awayteam_id = team2.id
                WHERE event.date BETWEEN ' . $startdate .' AND ' . $enddate. ' 
                ORDER BY event.date ASC';

        $ergebnis = $sql_connection->connect()->prepare($sql);
        $ergebnis->execute();

        $string = $ergebnis->fetchAll();

        return $string;
    }
}