<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author nightwalker
 */
class dashboard extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        
        $data['page_title'] = "Dashboard";
        $this->load->view('header', $data);
        $this->load->view('dashboard');
        $this->load->view('footer');
    }
    
    
}
