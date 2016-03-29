<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_control
 *
 * @author nightwalker
 */
class user_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_control_model');
    }

    function login() {
        $success = false;
        $message = "";

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $r = $this->user_control_model->getUser($username, $password);

        $userdata = array();

        if ($r == false) {
            $success = false;
            $message = "Login failed, Username or Password incorrect";
        } else {

            foreach ($r as $l) {
                $userdata['user_username'] = $l->user_username;
                $userdata['user_nama'] = $l->user_nama;
                $userdata['user_alamat'] = $l->user_alamat;
                $userdata['user_kota'] = $l->user_kota;
                $userdata['user_hp'] = $l->user_hp;
                $userdata['user_group_kode'] = $l->user_group_kode;
                $userdata['usrgroup_nama'] = $l->usrgroup_nama;
                $userdata['user_state'] = $l->user_state;
            }

            if ($userdata['user_state'] == '0') {
                $success = false;
                $message = "Login failed, Username or Password incorrect";
            } else {
                $this->session->set_userdata($userdata);
                //redirect(base_url() . "dashboard", 'refresh');
                $success = true;
                $message = "Login success";
            }
        }

        $ret = array(
            'success' => $success,
            'message' => $message
        );

        echo json_encode($ret);
    }

    function logout() {
        $userdata = array();
        $userdata['user_username'] = "";
        $userdata['user_nama'] = "";
        $userdata['user_alamat'] = "";
        $userdata['user_kota'] = "";
        $userdata['user_hp'] = "";
        $userdata['user_group_kode'] = "";
        $userdata['usrgroup_nama'] = "";
        $userdata['user_state'] = "";

        $this->session->unset_userdata($userdata);
        redirect(base_url(), 'refresh');
    }
    
    
    

}
