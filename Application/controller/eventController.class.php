<?php


class eventController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $this->show();
    }

    public function show(int $event_id = null)
    {

    }

    public function edit(int $event_id = null)
    {
        // Check if Event ID was passed
        $event = !empty($event_id) ? Event::loadEvent($event_id) : null;

        // Create view and set parameters
        $this->view('editevent',[
            'event' => $event,
            'sports' => Sport::loadAllSports(),
            'teams' => Team::loadAllTeams()
        ]);

        $this->view->page_title = $event != null ? 'Edit Event' : 'New Event';
        $this->view->render();
    }
}