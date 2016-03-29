<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        //nothing todo jackass
    }

    public function login() {
        
        if (!is_null($this->session->userdata('user_username'))) {
            if ($this->session->userdata('user_username') == "") {
                $this->load->view('welcome_message');
            }
            else
            {
                redirect(base_url());
            }
        } else {
            $this->load->view('welcome_message');
        }
        
        
    }

}
