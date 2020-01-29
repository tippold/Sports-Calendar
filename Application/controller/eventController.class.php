<?php


class eventController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $this->event();
    }

    public function show(int $event_id = null)
    {

    }

    public function add()
    {
        $this->edit(null);
    }

    public function edit(int $event_id = null)
    {
        // Check POST data on Callback from Form submission

        if(isset($_POST['editevent']) && !empty($_POST['editevent']))
        {
            //echo"EDIT EVENT";
            $event_id = $_POST['editevent'];

            $event = Event::loadEvent($event_id);
            $event->date = $_POST['date'];
            $event->start_time = $_POST['start_time'];
            $event->_hometeam_id = $_POST['home_team_id'];
            $event->_awayteam_id = $_POST['away_team_id'];
            $event->_sport_id = $_POST['sport_id'];
            $event->_venue_id = NULL;
            $event->save();

        } elseif(isset($_POST['addevent'])){

            //echo"ADD EVENT";
            $event = new Event();
            $event->date = $_POST['date'];
            $event->start_time = $_POST['start_time'];
            $event->_hometeam_id = $_POST['home_team_id'];
            $event->_awayteam_id = $_POST['away_team_id'];
            $event->_sport_id = $_POST['sport_id'];
            $event->_venue_id = NULL;
            $event->save();

            $event_id = $event->getId();
        }

        // Check if Event ID was passed
        $event = !empty($event_id) ? Event::loadEvent($event_id) : null;

        // Create view and set parameters
        $this->view('editevent',[
            'event' => $event,
            'sports' => Sport::loadAllSports(),
            'teams' => Team::loadAllTeams()
        ]);

        $this->view->page_title = $event != null ? 'Edit Event' : 'Add Event';
        $this->view->render();
    }
}