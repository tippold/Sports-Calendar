<?php


class calendarController extends Controller
{
    public function __construct()
    {
    }

    public function index($id='',$name='')
    {
        $this->view('calendar',[
            'name' => $name,
            'id' => $id
        ]);

        //var_dump($this);
        $this->view->page_title = 'Calendar';
        $this->view->render();
    }
}