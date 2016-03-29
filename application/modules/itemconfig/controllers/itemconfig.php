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
        
        $this->load->helper('url');
        $this->load->view('header', $data);
        $this->load->view('barang_konfigurasi');
        $this->load->view('footer');
    }

// FUNCTION KATEGORI //
    public function ajax_list(){
        $list = $this->model_itemconfig->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $kategori) {
            $no++;
            $row = array();
            $row[] = $kategori->bargori_nama;
            $row[] = $kategori->bargori_prefix;

            //add html for action
            $row[] = '<span class="badge badge-info badge-roundless"> 28 </span>';
            $row[] = '<div class="btn-group"><a href="#" data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle"><span class="fa fa-ellipsis-v"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="javascript:void()" title="Edit" onclick="edit_kategori('."'".$kategori->bargori_id."'".')"> Edit</a></li>
                            <li><a href="javascript:void()" title="Hapus" onclick="delete_kategori('."'".$kategori->bargori_id."'".')"> Delete</a></li>
                        </ul>
                      </div>';
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model_itemconfig->count_all(),
                        "recordsFiltered" => $this->model_itemconfig->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function addKategori(){
        $data = array(
            'bargori_nama'      => $this->input->post('kategoriNama'),
            'bargori_prefix'    => $this->input->post('kategoriPrefix'),
            'bargori_createdat' => $this->input->post('kategoriTimestamp'),
            'bargori_createdby' => $this->input->post('kategoriCreator')
        );
        $this->model_itemconfig->save($data);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_edit($bargori_id){
        $data = $this->model_itemconfig->get_by_kode($bargori_id);
        echo json_encode($data);
    }

    function ajax_delete($bargori_id){
        $this->model_itemconfig->delete_by_id($bargori_id);
        echo json_encode(array("status" => TRUE));
    }

    function editKategoriAjax(){
        $data = array(
                'bargori_nama'      => $this->input->post('kategoriEditNama'),
                'bargori_prefix'    => $this->input->post('kategoriEditPrefix'),
                'bargori_updatedat' => $this->input->post('kategoriEditTimestamp'),
                'bargori_updatedby' => $this->input->post('kategoriEditCreator'),                
            );
        $this->model_itemconfig->update(array('bargori_id' => $this->input->post('kategoriEditId')), $data);
        echo json_encode(array("status" => TRUE));
    }
// FUNCTION KATEGORI //

// FUNCTION MERK //
    public function ajax_list_merk(){
        $list = $this->model_itemconfig->get_datatables_merk();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $merk) {
            $no++;
            $row = array();
            $row[] = $merk->barmerk_nama;
            $row[] = $merk->barmerk_prefix;

            //add html for action
            $row[] = '<span class="badge badge-info badge-roundless"> 28 </span>';
            $row[] = '<div class="btn-group"><a href="#" data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle"><span class="fa fa-ellipsis-v"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="javascript:void()" title="Edit" onclick="edit_merk('."'".$merk->barmerk_id."'".')"> Edit</a></li>
                            <li><a href="javascript:void()" title="Hapus" onclick="delete_merk('."'".$merk->barmerk_id."'".')"> Delete</a></li>
                        </ul>
                      </div>';
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model_itemconfig->count_all_merk(),
                        "recordsFiltered" => $this->model_itemconfig->count_filtered_merk(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function addMerk(){
        $data = array(
            'barmerk_nama'      => $this->input->post('merkNama'),
            'barmerk_prefix'    => $this->input->post('merkPrefix'),
//            'barmerk_createdat' => $this->input->post('kategoriTimestamp'),
//            'barmerk_createdby' => $this->input->post('kategoriCreator')
        );
        $this->model_itemconfig->save_merk($data);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_edit_merk($barmerk_id){
        $data = $this->model_itemconfig->get_by_kode_merk($barmerk_id);
        echo json_encode($data);
    }

    function ajax_delete_merk($barmerk_id){
        $this->model_itemconfig->delete_by_id_merk($barmerk_id);
        echo json_encode(array("status" => TRUE));
    }

    function editMerkAjax(){
       $data = array(
               'barmerk_nama'      => $this->input->post('merkEditNama'),
               'barmerk_prefix'    => $this->input->post('merkEditPrefix'),
               // 'barmerk_updatedat' => $this->input->post('kategoriEditTimestamp'),
               // 'barmerk_updatedby' => $this->input->post('kategoriEditCreator'),                
           );
       $this->model_itemconfig->update_merk(array('barmerk_id' => $this->input->post('merkEditId')), $data);
       echo json_encode(array("status" => TRUE));
    }
// FUNCTION MERK //
}
