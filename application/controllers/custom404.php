<?php

class custom404 extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->output->set_status_header('404'); // setting header to 404
        $data['page_title']="Page not found";
        $this->load->view('v404', $data); //loading view
    }
}
