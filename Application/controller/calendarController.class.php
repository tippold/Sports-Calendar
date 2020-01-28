<?php


class calendarController extends Controller
{
    private $keydate;
    private $numberOfDays;
    private $emptyDays;

    public function __construct()
    {
    }

    public function index()
    {
        $this->calculateDays();

        $this->view('calendar',[
            'year' => date("Y", $this->keydate),
            'month'=> date("F", $this->keydate),
            'numberOfDays' => $this->numberOfDays,
            'emptyDays' => $this->emptyDays
        ]);

        $this->view->page_title = 'Calendar';
        //$this->view->css_path = 'calendar.css';
        $this->view->render();

        $allEvents = Event::loadEventsByMonth(date("Y",$this->keydate),date("n",$this->keydate));

        print_r($allEvents);
    }

    public function show($year='', $month='')
    {
        if(empty($year) || empty($month))
        {
            $this->index();
            return;
        }

        $this->calculateDays($year, $month);

        $this->view('calendar',[
            'year' => date("Y", $this->keydate),
            'month'=> date("F", $this->keydate),
            'numberOfDays' => $this->numberOfDays,
            'emptyDays' => $this->emptyDays
        ]);

        $this->view->page_title = 'Calendar';
        $this->view->render();

        $allEvents = Event::loadEventsByMonth(date("Y",$this->keydate),date("n",$this->keydate));

        print_r($allEvents);
    }

    private function calculateDays($year='', $month='')
    {
        if(empty($year) || empty($month))
        {
            $this->keydate = mktime(0,0,0, date("n"), 1,date("Y"));
        }
        else {
            $this->keydate = mktime(0,0,0,$month,1,$year);
        }

        $this->numberOfDays = date("t", $this->keydate);
        $this->emptyDays = date("N", $this->keydate) - 1;
    }
}