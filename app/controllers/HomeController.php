<?php
// app/controllers/HomeController.php
require_once 'app/controllers/BaseController.php';

class HomeController extends BaseController {
    public function index() {
        // Display welcome page
        $this->view('home/welcome');
    }
}
?>
