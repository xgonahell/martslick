<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pegawai
 *
 * @author cornnuclear
 */
class pegawai extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('model_pegawai');
    }
    
    public function index(){
        $data['page_title'] = "Pegawai";
        $data['timestamp']  = date('Y-m-d H:i:s');
        $data['creator']    = $this->session->userdata('user_username');
        $data['user']       = $this->model_pegawai->getAll('user');
        $data['group']      = $this->model_pegawai->getAll('user_group');
        
        $this->load->helper('url');
        $this->load->view('header', $data);
        $this->load->view('data_pegawai');
        $this->load->view('footer');
    }

// FUNCTION PEGAWAI //
    public function ajax_list(){
        $list = $this->model_pegawai->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user){
            $no++;
            $row = array();
            $row[] = $user->user_username;
            $row[] = $user->user_nama;
            $row[] = $user->user_alamat;
            $row[] = $user->user_kota;
            $row[] = $user->user_hp;            

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_user('."'".$user->user_username."'".')"><i class="fa fa-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_user('."'".$user->user_username."'".')"><i class="fa fa-trash"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model_pegawai->count_all(),
                        "recordsFiltered" => $this->model_pegawai->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function ajax_add(){
        $data = array(
            'user_username'    => $this->input->post('userUsername'),
            'user_password'    => md5($this->input->post('userPassword')),
            'user_passwordx'   => $this->input->post('userPasswordx'),
            'user_group_kode'  => $this->input->post('userGroup'),
            'user_nama'        => $this->input->post('userNama'),
            'user_alamat'      => $this->input->post('userAlamat'),
            'user_kota'        => $this->input->post('userKota'),
            'user_hp'          => $this->input->post('userHp'),
            'user_createdat'   => $this->input->post('userTimestamp'),
            'user_createdby'   => $this->input->post('userCreator'),
        );
        $this->model_pegawai->save($data);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_edit($user_username){
        $data = $this->model_pegawai->get_by_kode($user_username);
        echo json_encode($data);
    }

    function ajax_delete($user_username){
        $this->model_pegawai->delete_by_id($user_username);
        echo json_encode(array("status" => TRUE));
    }

    function editUserAjax(){
        $data = array(
            'user_username'    => $this->input->post('userUsername'),
            'user_password'    => md5($this->input->post('userPassword')),
            'user_passwordx'   => $this->input->post('userpasswordx'),
            'user_group_kode'  => $this->input->post('userGroup'),
            'user_nama'        => $this->input->post('userNama'),
            'user_alamat'      => $this->input->post('userAlamat'),
            'user_kota'        => $this->input->post('userKota'),
            'user_hp'          => $this->input->post('userHp'),
            'user_udatedat'   => $this->input->post('userTimestamp'),
            'user_udatedby'   => $this->input->post('userCreator'),
        );
        $this->model_pegawai->update(array('user_username' => $this->input->post('userUsername')), $data);
        echo json_encode(array("status" => TRUE));
    }
// FUNCTION PEGAWAI //
}