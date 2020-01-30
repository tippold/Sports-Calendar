<?php

class Event
{
    // columns of Event MySQL table
    private $id = '';
    public $date = '';
    public $start_time = '';
    public $_hometeam_id = '';
    public $_awayteam_id = '';
    public $_sport_id = '';
    public $_venue_id = '';

    // Additional info (through MySQL join)
    public $home_team_name = '';
    public $home_team_code ='';
    public $away_team_name = '';
    public $away_team_code = '';
    public $sport_name = '';

    public function __construct()
    {
    }

    public function save()
    {
        // Saves Event to Database
        // If Event ID is set perform UPDATE - otherwise INSERT

        $insert = false;
        if( !empty($this->id) )
        {
            // Edit Event
            $sql = "UPDATE event SET date = :date, start_time = :start_time, _hometeam_id = :hometeam_id, _awayteam_id = :awayteam_id, _sport_id = :sport_id, _venue_id = :venue_id WHERE event.id = :eventid";
        }
        else{
            // New Event
            $insert = true;
            $sql = 'INSERT INTO event (id, date, start_time, _hometeam_id, _awayteam_id, _sport_id, _venue_id) VALUES (NULL, :date, :start_time, :hometeam_id, :awayteam_id, :sport_id, :venue_id)';
        }

        //SQL Data Binding and Execution
        $connection = new mySqlConnection();
        $eintrag = $connection->connect()->prepare($sql);
        $eintrag->bindValue(":date", $this->date);
        $eintrag->bindValue(":start_time", $this->start_time);
        $eintrag->bindValue(":hometeam_id", $this->_hometeam_id);
        $eintrag->bindValue(":awayteam_id", $this->_awayteam_id);
        $eintrag->bindValue(":sport_id", $this->_sport_id);
        $eintrag->bindValue(":venue_id", NULL);
        if( !empty($this->id) ) $eintrag->bindValue(":eventid",$this->id);

        $eintrag->execute();

        if ($insert) $this->id = $connection->connect()->lastInsertId();
    }

    public static function loadEvent(int $id)
    {
        // Returns Single Event Object by Event ID

        $sql_connection = new mySqlConnection();
        $sql = "SELECT event.id, event.date, start_time, team1.id AS _hometeam_id, team2.id AS _awayteam_id, team1.team_name AS home_team_name, team1.team_code AS home_team_code, team2.team_name AS away_team_name, team2.team_code AS away_team_code, sport_name, event._sport_id, event._venue_id
                FROM event 
                JOIN sport ON event._sport_id = sport.id
                JOIN team AS team1 ON event._hometeam_id = team1.id
                JOIN team AS team2 ON event._awayteam_id = team2.id
                WHERE event.id = :id";

        $statement = $sql_connection->connect()->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Event');
        $statement->bindValue(":id", $id);
        $statement->execute();
        $event = $statement->fetch();

        return $event;
    }

    public static function loadEventsByMonth(int $year, int $month, int $sport = null)
    {
        //Returns array of all Events of specified month (sport filter optional)

        //Determine first and last day of month
        $enddate = date('Y-m-d', mktime(0,0,0,$month + 1,0,$year) );
        $startdate = date('Y-m-d', mktime(0,0,0,$month,1,$year) );

        // SQL statement
        $sql_connection = new mySqlConnection();
        $sql = "SELECT event.id AS id, event.date, start_time, team1.id AS _hometeam_id, team2.id AS _awayteam_id, team1.team_name AS home_team_name, team1.team_code AS home_team_code, team2.team_name AS away_team_name, team2.team_code AS away_team_code, sport_name, event._sport_id, event._venue_id
                FROM event 
                JOIN sport ON event._sport_id = sport.id
                JOIN team AS team1 ON event._hometeam_id = team1.id
                JOIN team AS team2 ON event._awayteam_id = team2.id
                WHERE event.date BETWEEN :startdate AND :enddate";

        // Add sport filter if specified
        if(!empty($sport))
        {
            $sql .= " AND _sport_id = :sport_id";
        }
        $sql .= " ORDER BY event.date ASC, event.start_time ASC";

        // Execute SQL query and return Event objects
        $statement = $sql_connection->connect()->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Event');
        $statement->bindValue(":startdate",$startdate);
        $statement->bindValue(":enddate",$enddate);
        if(!empty($sport)) $statement->bindValue(":sport_id", $sport);
        $statement->execute();
        $allEvents = $statement->fetchAll();

        return $allEvents;
    }

    public function getId()
    {
        return $this->id;
    }
}