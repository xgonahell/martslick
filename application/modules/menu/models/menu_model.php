<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu_model
 *
 * @author nightwalker
 */
class menu_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getmenu() {
        $q = "SELECT "
                . "a.module_id,"
                . "a.module_name, "
                . "a.module_controller, "
                . "a.module_parent as module_parent_id,"
                . "(select b.module_name from module b where b.module_id = a.module_parent) as module_parent, "
                . "a.module_order, "
                . "a.module_active_flag "
                . "FROM marts.module a order by a.module_parent, a.module_order ASC";
        return $this->db->query($q)->result();
    }

    function get_parent_list() {
        $q = "select a.module_id, a.module_name FROM marts.module a";
        return $this->db->query($q)->result();
    }

    function set_order($dir, $module_id) {
        $q1 = "SELECT module_order from module WHERE module_id = '$module_id'";
        $n = $this->db->query($q1)->row()->module_order;

        if ($dir == "up") {
            $n = $n - 1;
        } else {
            $n = $n + 1;
        }

        $q2 = "UPDATE module set module_order = $n WHERE module_id = '$module_id'";
        $this->db->query($q2);
    }

    function set_active($state, $module_id) {
        $q = "UPDATE module set module_active_flag = '$state' WHERE module_id = '$module_id'";
        $q2 = "UPDATE module set module_active_flag = '$state' WHERE module_parent = '$module_id' AND module_controller not in ('menu')";
        $this->db->query($q);
        $this->db->query($q2);
    }
    
    function delete($module_id)
    {
        $q = "delete from module where module_id = '$module_id'";
        $this->db->query($q);
    }
    

    function save($module_id = '', $module_name = '', $module_controller = '', $module_parent = '') {
        if($module_parent=="")
        {
            $module_parent = "0";
        }
        try {
            if ($module_id != "") {
                $q = "update module set module_name = '$module_name', module_controller='$module_controller', module_parent='$module_parent' WHERE module_id = '$module_id'";
            } else {
                $q = "insert into module (module_name, module_controller, module_parent, module_active_flag, module_order)VALUES('$module_name','$module_controller', '$module_parent', '1','0');";
            }

            $this->db->query($q);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
