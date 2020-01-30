<?php

class calendarController extends Controller
{
    private $keydate;
    private $days = [];

    public function __construct()
    {
    }

    public function index()
    {
        $this->show();
    }

    public function show(int $year = null, int $month = null)
    {
        // check if sport filter was set in POST
        $sport = isset($_POST['sport_filter']) && !empty($_POST['sport_filter']) ? $_POST['sport_filter'] : null;

        $this->generateDays($year, $month, $sport);

        // Create view and set parameters
        $this->view('calendar',[
            'keydate' => $this->keydate,
            'prev_month'=> date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-d', $this->keydate)))),
            'next_month'=> date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', $this->keydate)))),
            'days' => $this->days,
            'sports' => Sport::loadAllSports(),
            'sport_filter'=>$sport
        ]);

        $this->view->page_title = 'Calendar';
        $this->view->js_path = JS . 'calendar.js';
        $this->view->render();
    }

    private function generateDays(int $year = null, int $month = null, int $sport = null)
    {
        // Method fills $days with associative Array of days and their events ( day => [Events])

        // determines reference timestamp
        if(empty($year) || empty($month))
        {
            $this->keydate = mktime(0,0,0, date("n"), 1,date("Y"));
        }
        else {
            $this->keydate = mktime(0,0,0,$month,1,$year);
        }

        // Determines first and last day of month
        $firstday = date("Y-m-d", $this->keydate);
        $lastday = date("Y-m-t",$this->keydate);

        // Load Events
        $allEvents = Event::loadEventsByMonth(date("Y",$this->keydate), date("n",$this->keydate), $sport);

        // Fill array keys with dates of days
        $allDates = [];
        while(strtotime($firstday) <= strtotime($lastday))
        {
            array_push($allDates,$firstday);
            $firstday = date ("Y-m-d", strtotime("+1 day", strtotime($firstday)));
        }
        $allDays = array_fill_keys($allDates, []);

        // Fill array values with Events
        foreach($allEvents as $event)
        {
            array_push($allDays[$event->date], $event);
        }

        $this->days = $allDays;
    }
}