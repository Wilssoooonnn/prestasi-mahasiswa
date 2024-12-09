<?php
require_once "../app/core/Controller.php";
require_once "../config/database.php";
class LandingPageController extends Controller
{
    public function __construct()
    {
        $db = new Database();
        $db->connect();
    }

    public function landingPage()
    {
        $view = new Controller();
        $view->view('/template/header', ['judul' => 'Landing Page']);
        $view->view('landingPage');
        $view->view('/template/footer');
    }
}
