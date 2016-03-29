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
class menu extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
    }

    public function index() {
        $data['list_menu'] = $this->menu_model->getmenu();
        $data['list_parent'] = $this->menu_model->get_parent_list();
        $data['page_title'] = "Menu";
        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('footer');
    }

    public function set_order($direction = '', $module_id = '') {

        $this->menu_model->set_order($direction, $module_id);
        redirect(base_url() . 'menu');
    }

    public function set_active($state = '', $module_id = '') {
        $this->menu_model->set_active($state, $module_id);
        redirect(base_url() . 'menu');
    }

    function delete($module_id='')
    {
        $this->menu_model->delete($module_id);
        redirect(base_url() . 'menu');
    }
    
    function save() {
        $module_id = $this->input->post('module_id');
        $module_name = $this->input->post('module_name');
        $module_controller = $this->input->post('module_controller');
        $module_parent = $this->input->post('module_parent');
        $ret = $this->menu_model->save($module_id, $module_name, $module_controller, $module_parent);

        if ($ret == false) {
           $message = "Gagal menyimpan data"; 
        } else {
           $message = "Data berhasil disimpan";
        }
        
        $st = array(
            'success' => $ret,
            'message' => $message
        );
        
        echo json_encode($st);
    }

}
