<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of operasional
 *
 * @author cornnuclear
 */
class operasional extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('model_operasional');
    }
    
    public function index(){
        $data['page_title']     = "Pengeluaran";
        $data['timestamp']      = date('Y-m-d H:i:s');
        $data['creator']        = $this->session->userdata('user_username');
        $data['operasional']    = $this->model_operasional->getAllItem('operasional');
        $data['oprKode']        = $this->model_operasional->getCodeOperasional();

        
        $this->load->helper('url');
        $this->load->view('header', $data);
        $this->load->view('data_operasional');
        $this->load->view('footer');
    }

// FUNCTION Operasional //
    public function ajax_list(){
        $list = $this->model_operasional->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $operasional){
            $no++;
            $row = array();
            $row[] = $operasional->opr_kode;
            $row[] = $operasional->opr_createdat;
            $row[] = $operasional->opr_desc;
            $row[] = $operasional->opr_nominal;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_operasional('."'".$operasional->opr_kode."'".')"><i class="fa fa-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_operasional('."'".$operasional->opr_kode."'".')"><i class="fa fa-trash"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model_operasional->count_all(),
                        "recordsFiltered" => $this->model_operasional->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function ajax_add(){
        $data = array(
            'opr_kode'          => $this->input->post('oprKode'),
            'opr_desc'          => $this->input->post('oprDesc'),
            'opr_nominal'       => $this->input->post('oprNominal'),
            'opr_createdat'     => $this->input->post('oprTimestamp'),
            'opr_createdby'     => $this->input->post('oprCreator')
        );
        $this->model_operasional->save($data);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_edit($opr_kode){
        $data = $this->model_operasional->get_by_kode($opr_kode);
        echo json_encode($data);
    }

    function ajax_delete($opr_kode){
        $this->model_operasional->delete_by_id($opr_kode);
        echo json_encode(array("status" => TRUE));
    }

    function editOperasionalAjax(){
        $data = array(
            'opr_kode'          => $this->input->post('oprKode'),
            'opr_desc'          => $this->input->post('oprDesc'),
            'opr_nominal'       => $this->input->post('oprNominal'),
            'opr_updatedat'     => $this->input->post('oprTimestamp'),
            'opr_updatedby'     => $this->input->post('oprCreator')
        );
        $this->model_operasional->update(array('opr_kode' => $this->input->post('oprKode')), $data);
        echo json_encode(array("status" => TRUE));
    }
// FUNCTION Operasional //
}