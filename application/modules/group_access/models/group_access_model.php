<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of group_access_model
 *
 * @author nightwalker
 */
class group_access_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function save($id = '', $group_name = ''){
        $q = "";
        $q2 = "";
        if ($id == "") {
            $q = "SELECT COUNT(*) as cnt FROM user_group WHERE usrgroup_nama = '$group_name'";
            $c = $this->db->query($q)->row()->cnt;
            if ($c > 0) {
                return false;
            } else {
                $q2 = "INSERT INTO user_group (usrgroup_nama)VALUES('$group_name')";
                $this->db->query($q2);
                return true;
            }
        }
        else
        {
            $q2 = "UPDATE user_group SET usrgroup_nama = '$group_name' WHERE usrgroup_id = '$id'";
            $this->db->query($q2);
            return true;
        }
    }
    
    function delete($id)
    {
        $q = "delete from user_group WHERE usrgroup_id = '$id'";
        $q2 = "delete from user_group_access where usergroup_id = '$id'";
        $q3 = "delete from user where user_group_kode = $id'";
        $this->db->query($q);
        $this->db->query($q2);
        $this->db->query($q3);
    }

    function get_group() {
        $q = "select usrgroup_id, usrgroup_nama from user_group";
        return $this->db->query($q)->result();
    }

    function get_module($group_id = '') {
        $q = "SELECT module_id, module_name, module_controller, module_parent, status FROM(
        select a.module_id, a.module_name, a.module_controller, a.module_parent, b.status from module a
        left join user_group_access b on b.module_id = a.module_id and b.usergroup_id = '$group_id'
        WHERE a.module_controller <> '#'
        UNION ALL
        select a.module_id, a.module_name, a.module_controller, a.module_parent, b.status from module a 
        left join user_group_access b on b.module_id = a.module_id
        WHERE a.module_controller <> '#' and b.usergroup_id='$group_id'
        )t
        GROUP BY module_id, module_name, module_controller, module_parent, status";
        return $this->db->query($q)->result();
    }

    function upstate($group_id = '', $module_id = '', $state = '') {
        $q = "SELECT count(module_id) as cnt from user_group_access WHERE module_id = '$module_id' AND usergroup_id = '$group_id'";
        $c = $this->db->query($q)->row()->cnt;
        if ($c > 0) {
            $q2 = "update user_group_access SET status = '$state' WHERE module_id = '$module_id' AND usergroup_id = '$group_id'";
        } else {
            $q2 = "insert into user_group_access (usergroup_id, module_id, status) values ('$group_id', '$module_id','$state')";
        }
        $this->db->query($q2);
    }

}
