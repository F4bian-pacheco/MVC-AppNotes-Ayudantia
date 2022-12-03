<?php 


class homeController {
    public $page_title;
    public $view;

    public function __construct()
    {
        $this->page_title = "Home";
        $this->view = "home";
    }

}


?>