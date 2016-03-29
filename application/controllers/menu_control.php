<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu_control
 *
 * @author nightwalker
 */
class menu_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('menu_control_model');
    }

   

}
