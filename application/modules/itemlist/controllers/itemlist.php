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
class itemlist extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('model_itemlist');
        $this->load->helper('currency_format_helper');
    }
    
    public function index(){
        $data['page_title'] = "Data Barang";
        $data['timestamp']  = date('Y-m-d H:i:s');
        $data['creator']    = $this->session->userdata('user_username');
        $data['items']      = $this->model_itemlist->getAllItem('barang_data');

        $this->load->view('header', $data);
        $this->load->view('data_barang');
        $this->load->view('footer');
    }

    function pageAdd(){
        $data['page_title'] = "Input Barang";

        $data['kategori']   = $this->model_itemlist->getAll('barang_kategori');
        $data['ukuran']     = $this->model_itemlist->getAll('barang_ukuran');
        $data['lastCode']   = $this->model_itemlist->getLastItemId();
        $data['kategoriPrefix'] = $this->model_itemlist->getPrefixByID('bargori_id');

        $data['timestamp']  = date('Y-m-d H:i:s');
        $data['creator']    = $this->session->userdata('user_username');

        $this->load->view('header', $data);
        $this->load->view('page_add_barang');
        $this->load->view('footer');
    }

    function add(){
        $data = array(
            'barang_kategori_prefix'    => $this->input->post('barangKategori'),
            'barang_kode'               => $this->input->post('barangKode'),
            'barang_desc'               => $this->input->post('barangDeskripsi'),
            'barang_qty'                => $this->input->post('barangQty'),
            'barang_harga_beli'         => $this->input->post('barangHargaBeli'),
            'barang_harga_jual'         => $this->input->post('barangHargaJual'),
            'barang_createdby'          => $this->input->post('barangCreator'),
            'barang_createdat'          => $this->input->post('barangTimestamp'),
        );
        $this->model_itemlist->create('barang_data', $data);
        redirect('itemlist');
    }
}
