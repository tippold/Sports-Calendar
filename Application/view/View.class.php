<?php

class View
{
    protected $view_file;
    protected $view_data;
    public $page_title = 'Please set a title';

    public function __construct($view_file,$view_data)
    {
        $this->view_file = $view_file;
        $this->view_data = $view_data;
    }

    public function render()
    {
        $filepath = VIEW . $this->view_file . '.php';

        if(file_exists($filepath))
        {
            include VIEW . 'header.php';
            include $filepath;
            include VIEW . 'footer.php';
        }
    }
}