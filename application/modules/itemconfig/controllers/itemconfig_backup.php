<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of itemlist
 *
 * @author cornnuclear
 */
class itemconfig extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('model_itemconfig');
    }
    
    public function index(){
        $data['page_title'] = "Master Barang";
        $data['timestamp']  = date('Y-m-d H:i:s');
        $data['creator']    = $this->session->userdata('user_username');
        $data['kategori']   = $this->model_itemconfig->getAll('barang_kategori');
        $data['ukuran']     = $this->model_itemconfig->getAll('barang_ukuran');
        $data['warna']      = $this->model_itemconfig->getAll('barang_warna');
        
        $this->load->view('header', $data);
        $this->load->view('barang_konfigurasi');
        $this->load->view('footer');
    }

    function addWarna(){
        $data = array(
            'barwar_nama'  => $this->input->post('barwarNama'),
            'barwar_prefix'    => $this->input->post('barwarPrefix'),
        );
        $this->model_itemconfig->create('barang_warna', $data);
        redirect('itemconfig');
    }

    function addWarnaAjax(){
        $data = array(
            'barwar_nama'  => $this->input->post('barwarNama'),
            'barwar_prefix'    => $this->input->post('barwarPrefix'),
        );
        $this->model_itemconfig->create('barang_warna', $data);
        echo json_encode(array("status" => TRUE));
    }
}
