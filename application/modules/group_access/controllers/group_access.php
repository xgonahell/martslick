<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu
 *
 * @author nightwalker
 */
class group_access extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('group_access_model');
        $this->load->model('menu/menu_model');
    }

    public function index() {

        $data['list_group'] = $this->group_access_model->get_group();
        $data['page_title'] = "Group Access";
        $this->load->view('header', $data);
        $this->load->view('group_access', $data);
        $this->load->view('footer');
    }

    public function get_module() {
        $group_id = $this->input->post('group_id');
        $data['data'] = $this->group_access_model->get_module($group_id);
        echo json_encode($data);
    }

    public function upstate() {
        $group_id = $this->input->post('group_id');
        $module_id = $this->input->post('module_id');
        $state = $this->input->post('state');
        $this->group_access_model->upstate($group_id, $module_id, $state);
    }

    public function save() {
        $success = false;
        $message = "";
        $group_id = $this->input->post('group_id');
        $group_name = $this->input->post('group_name');
        $res = $this->group_access_model->save($group_id, $group_name);
        if ($res == true) {
            $success = $res;
            $message = "Data sucessfuly saved";
        } else {
            $success = $res;
            $message = "Could not save duplicate group name";
        }
        
        $data['success'] = $success;
        $data['message']=$message;
        echo json_encode($data);
    }
    
    public function delete($id='')
    {
        $group_id = $id;
        $this->group_access_model->delete($group_id);
        redirect(base_url()."group_access");
    }

}
