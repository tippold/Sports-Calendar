<?php

class calendarController extends Controller
{
    private $keydate;
    private $numberOfDays;
    private $emptyDays;
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
        $this->generateDays($year, $month);

        $this->view('calendar',[
            'year' => date("Y", $this->keydate),
            'month'=> date("F", $this->keydate),
            'keydate' => $this->keydate,
            'days' => $this->days,
            'numberOfDays' => $this->numberOfDays,
            'emptyDays' => $this->emptyDays
        ]);

        $this->view->page_title = 'Calendar';
        $this->view->render();
    }

    private function generateDays(int $year = null, int $month = null)
    {
        if(empty($year) || empty($month))
        {
            $this->keydate = mktime(0,0,0, date("n"), 1,date("Y"));
        }
        else {
            $this->keydate = mktime(0,0,0,$month,1,$year);
        }

        $firstday = date("Y-m-d", $this->keydate);
        $lastday = date("Y-m-t",$this->keydate);
        $this->numberOfDays = date("t", $this->keydate);
        $this->emptyDays = date("N", $this->keydate) - 1;

        $allEvents = Event::loadEventsByMonth(date("Y",$this->keydate),date("n",$this->keydate));
        $allDates = [];

        while(strtotime($firstday) <= strtotime($lastday))
        {
            array_push($allDates,$firstday);
            $firstday = date ("Y-m-d", strtotime("+1 day", strtotime($firstday)));
        }

        $allDays = array_fill_keys($allDates, []);

        foreach($allEvents as $event)
        {
            array_push($allDays[$event->date], $event);
        }

        $this->days = $allDays;
    }
}