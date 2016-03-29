<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_control_model
 *
 * @author nightwalker
 */
class user_control_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getUser($username = '', $password = '') {
        $u = $username;
        $p = md5($password);
        $q = "select 
        count(a.user_username) as cnt,
        a.user_username, 
        a.user_nama, 
        a.user_alamat, 
        a.user_kota,
        a.user_hp,
        a.user_group_kode,
        b.usrgroup_nama,
        a.user_state
        from user a
        join user_group b on b.usrgroup_id = a.user_group_kode
        WHERE a.user_username = '$u' AND a.user_password = '$p'";

        $r = $this->db->query($q);
        if ($r->row()->cnt > 0) {
            return $r->result();
        } else {
            return false;
        }
    }

}
