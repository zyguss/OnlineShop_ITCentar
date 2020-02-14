<?php

class Home_Controller extends Controller {
    
    function index(){
        $homePage = $this->model->getPage('home_page');
        $this->view->homePage = $homePage;
        $this->view->render('home/home_page.php');
    }
}

?>