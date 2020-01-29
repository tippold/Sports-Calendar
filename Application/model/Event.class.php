<?php

class Event
{
    private $id = '';
    public $date = '';
    public $start_time = '';
    public $home_team_name = '';
    public $home_team_code = '';
    public $away_team_name = '';
    public $away_team_code = '';
    public $sport = '';

    public function __construct()
    {
    }

    public function save()
    {
        // If Event ID is set perform UPDATE - otherwise INSERT
        if( !empty($this->id) )
        {
            $sql = "";
        }
        else{
            $sql ="";
        }
    }

    public static function loadEvent(string $id)
    {
        // Returns Single Event Object by Event ID

        $sql_connection = new mySqlConnection();
        $sql = "SELECT event.id, event.date, start_time, team1.team_name AS home_team_name, team1.team_code AS home_team_code, team2.team_name AS away_team_name, team2.team_code AS away_team_code, sport_name AS sport
                FROM event 
                JOIN sport ON event._sport_id = sport.id
                JOIN team AS team1 ON event._hometeam_id = team1.id
                JOIN team AS team2 ON event._awayteam_id = team2.id
                WHERE event.id = ".$id;

        $statement = $sql_connection->connect()->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Event');
        $statement->execute();
        $event = $statement->fetch();

        return $event;
    }

    public static function loadEventsByMonth(int $year, int $month, int $sport = null)
    {
        //Returns array of all Events of specified month (sport filter optional)

        //Determine first and last day of month
        $enddate = "'". date('Y-m-d', mktime(0,0,0,$month + 1,0,$year) ) . "'";
        $startdate = "'" . date('Y-m-d', mktime(0,0,0,$month,1,$year) ) . "'";

        // SQL statement
        $sql_connection = new mySqlConnection();
        $sql = 'SELECT event.id, event.date, start_time, team1.team_name AS home_team_name, team1.team_code AS home_team_code, team2.team_name AS away_team_name, team2.team_code AS away_team_code, sport.id, sport_name AS sport
                FROM event 
                JOIN sport ON event._sport_id = sport.id
                JOIN team AS team1 ON event._hometeam_id = team1.id
                JOIN team AS team2 ON event._awayteam_id = team2.id
                WHERE event.date BETWEEN ' . $startdate .' AND ' . $enddate;

        // Add sport filter if specified
        if(!empty($sport))
        {
            $sql .= " AND sport.id = " . $sport;
        }
        $sql .= " ORDER BY event.date ASC, event.start_time ASC";

        // Execute SQL query and return Event objects
        $statement = $sql_connection->connect()->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Event');
        $statement->execute();
        $allEvents = $statement->fetchAll();

        return $allEvents;
    }
}