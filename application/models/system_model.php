<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of system_model
 *
 * @author nightwalker
 */
class system_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    //put your code here
    
    function get_sys_val($sys_cd='')
    {
        $q = "select system_val from system where system_cd = '$sys_cd'";
        return $this->db->query($q)->row()->system_val;
    }
}
