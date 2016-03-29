<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of supplier
 *
 * @author cornnuclear
 */
class supplier extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('model_supplier');
    }
    
    public function index(){
        $data['page_title']             = "Supplier";
        $data['timestamp']              = date('Y-m-d H:i:s');
        $data['creator']                = $this->session->userdata('user_username');
        $data['supplier_data']          = $this->model_supplier->getall('supplier');
        $data['supplierKode']           = $this->model_supplier->getSupplierCode();
        
        $this->load->helper('url');
        $this->load->view('header', $data);
        $this->load->view('data_supplier');
        $this->load->view('footer');
    }

// FUNCTION SUPPLIER //
    public function ajax_list(){
        $list = $this->model_supplier->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $supplier) {
            $no++;
            $row = array();
            $row[] = $supplier->supplier_kode;
            $row[] = $supplier->supplier_nama;
            $row[] = $supplier->supplier_alamat;
            $row[] = $supplier->supplier_kota;
            $row[] = $supplier->supplier_hp;
            $row[] = $supplier->supplier_email;

            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit_supplier('."'".$supplier->supplier_kode."'".')"><i class="fa fa-pencil"></i></a>
                  <a class="btn btn-xs btn-danger" href="javascript:void()" title="Hapus" onclick="delete_supplier('."'".$supplier->supplier_kode."'".')"><i class="fa fa-trash"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model_supplier->count_all(),
                        "recordsFiltered" => $this->model_supplier->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function ajax_add(){
        $data = array(
            'supplier_kode'        => $this->input->post('supplierKode'),
            'supplier_nama'        => $this->input->post('supplierNama'),
            'supplier_alamat'      => $this->input->post('supplierAlamat'),
            'supplier_kota'        => $this->input->post('supplierKota'),
            'supplier_hp'          => $this->input->post('supplierHP'),
            'supplier_email'       => $this->input->post('supplierEmail'),
            'supplier_createdat'   => $this->input->post('supplierTimestamp'),
            'supplier_createdby'   => $this->input->post('supplierCreator')
        );
        $this->model_supplier->save($data);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_getLastCode(){
        $data = $this->model_supplier->getSupplierCode();
        echo json_encode($data);
    }

    function ajax_edit($supplier_kode){
        $data = $this->model_supplier->getSupplierByID($supplier_kode);
        echo json_encode($data);
    }

    function ajax_delete($supplier_kode){
        $id['supplier_kode'] = $this->uri->segment(3);
        $this->model_supplier->delete_by_id($supplier_kode);
        echo json_encode(array("status" => TRUE));
    }

    function editSupplierAjax(){
         $data = array(
            'supplier_kode'        => $this->input->post('supplierKode'),
            'supplier_nama'        => $this->input->post('supplierNama'),
            'supplier_alamat'      => $this->input->post('supplierAlamat'),
            'supplier_kota'        => $this->input->post('supplierKota'),
            'supplier_hp'          => $this->input->post('supplierHP'),
            'supplier_email'       => $this->input->post('supplierEmail'),
            'supplier_udatedat'    => $this->input->post('supplierTimestamp'),
            'supplier_udatedby'    => $this->input->post('supplierCreator'),
        );
        $this->model_supplier->updateByID(array('supplier_kode' => $this->input->post('supplierKode')), $data);
        echo json_encode(array("status" => TRUE));
    }
// FUNCTION SUPPLIER //
}
