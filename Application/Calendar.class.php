<?php

class Calendar
{
    protected $controller ='calendarController';
    protected $action = 'index';
    protected $parameters = [];

    public function __construct()
    {
        $this->prepareURL();

        if(file_exists(CONTROLLER . $this->controller . '.class.php'))
        {
            $this->controller = new $this->controller;

            if(method_exists($this->controller,$this->action))
            {
                call_user_func_array([$this->controller,$this->action],$this->parameters);
            }
        }
        /*else{
            $this->controller = new calendarController;
            $this->action = 'index';
            $this->parameters = [];
            call_user_func_array([$this->controller,$this->action],$this->parameters);
        }*/
    }

    protected function prepareURL()
    {
        $request = ltrim($_SERVER['REQUEST_URI'],'/sportradar');
        $request = trim($request,'/');

        if(!empty($request))
        {
            $url = explode('/', $request);
            $this->controller = isset($url[0]) ? $url[0].'Controller' : 'calendarController';
            $this->action = isset($url[1]) ? $url[1] : 'index';

            unset($url[0],$url[1]);
            $this->parameters = !empty($url) ? array_values($url) : [];
        }
    }
}