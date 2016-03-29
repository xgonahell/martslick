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
class po extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('model_po');
        $this->load->helper('currency_format_helper');
    }
    
    public function index(){
        $data['page_title'] = "Data Purchase Order";
        $data['timestamp']  = date('Y-m-d H:i:s');
        $data['creator']    = $this->session->userdata('user_username');
        $data['items']      = $this->model_po->getAllItem('barang_data');
        $data['data_po']    = $this->model_po->getAllDataPO();

        $this->load->view('header');
        $this->load->view('po_mainpage', $data);
        $this->load->view('footer');
    }

// FUNCTION KATEGORI //
    public function ajax_list(){
        $list = $this->model_po->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_po) {
            $no++;
            if($data_po->po_status==1){
                $row[] = $data_po->po_status = 'Cash';
            }elseif($data_po->po_status==2){
                $row[] = $data_po->po_status = 'Kredit';
            }else{
                $row[] = $data_po->po_status = ':: Error information ::';
            }
            $row = array();
            $row[] = $no;
            $row[] = date("d M Y", strtotime($data_po->po_createdat));
            $row[] = $data_po->po_invoice;
            $row[] = currency_format($data_po->po_total_bayar);
            $row[] = $data_po->po_status;
            $row[] = '<span class="label label-success">' .$data_po->po_status_barang. '</span>';

            //add html for action
            $row[] = '<div class="btn-group"><a href="#" data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle"><span class="fa fa-ellipsis-v"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="po/invoice/'."$data_po->po_invoice".'"> Invoice</a></li>
                            <li><a href="po/transfer/'."$data_po->po_invoice".'"> Transfer</a></li>
                            <li><a href="javascript:void()" title="Hapus" onclick="delete_po('."'".$data_po->po_invoice."'".')"> Delete</a></li>
                        </ul>
                      </div>';
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model_po->count_all(),
                        "recordsFiltered" => $this->model_po->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function newpo(){
        $data['page_title'] = "New Purchase Order";

        $data['kategori']       = $this->model_po->getAll('barang_kategori');
        $data['merk']           = $this->model_po->getAll('barang_merk');
        $data['list_supplier']  = $this->model_po->getAll('supplier');
        $data['lastCode']   = $this->model_po->getLastItemId();
        // $data['kategoriPrefix'] = $this->model_po->getPrefixByID('bargori_id');

        $data['timestamp']  = date('Y-m-d H:i:s');
        $data['creator']    = $this->session->userdata('user_username');

        $this->load->view('header');
        $this->load->view('po_new', $data);
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

    function addToCart(){
        $data = array(
            'id'    => $this->input->post('poId'),
            'options'    => array('merk' => $this->input->post('poMerkBarang')),
            'name'  => $this->input->post('poKategoriBarang'),
            'qty'   => $this->input->post('poQuantity'),
            'price' => $this->input->post('poHargaBarang'),
        );
        $this->cart->insert($data);
        redirect('po/newpo');
    }

    function delFromCart($rowid){
        $data = array(
            'rowid' => $rowid,
            'qty'   => 0
        );
        $this->cart->update($data);
        redirect('po/newpo');
    }

    function fromCarttoDB(){
        $data = array(
            'po_invoice'        =>  $this->input->post('poheadInvoice'),
            'po_createdat'      =>  $this->input->post('poheadTanggal'),
            'po_supplier'       =>  $this->input->post('poheadSupplier'),
            'po_createdby'      =>  $this->input->post('poheadOperator'),
            'po_total_bayar'    =>  $this->input->post('poTotalBayar'),
            'po_status'         =>  $this->input->post('poheadStatus'),
            'po_status_barang'  =>  'Ready to transfer',
        );
        $this->model_po->create('po_head', $data);
        print_r($data);

        foreach($this->cart->contents() as $items){
            $podetail_merk      = $items['options']['merk'];
            $podetail_kategori  = $items['name'];
            $podetail_qty       = $items['qty'];
            $podetail_price     = $items['price'];
            $data_detail = array(
                'po_invoice'            => $this->input->post('poheadInvoice'),
                'po_detail_merk'        => $podetail_merk,
                'po_detail_kategori'    => $podetail_kategori,
                'po_detail_qty'         => $podetail_qty,
                'po_detail_price'       => $podetail_price,
            );
            $this->model_po->create('po_detail', $data_detail);
            }
            $this->session->unset_userdata('limit_add_cart');
            $this->cart->destroy();
            redirect('po');
    }

    function invoice(){
        $id = $this->uri->segment(3);
        $data['page_title']     = 'Faktur';
        $data['getInvoices']    = $this->model_po->getInvoiceItem($id);
        $data['detailInvoice']  = $this->model_po->getDetailPoItem($id);

        $this->load->view('header');
        $this->load->view('po_invoice', $data);
        $this->load->view('footer');
    }

    function transfer(){
        $data['timestamp']  = date('Y-m-d H:i:s');
        $data['creator']    = $this->session->userdata('user_username');
        $id = $this->uri->segment(3);
        $pref = $this->input->post('barangKategoriPrefix');

        $data['page_title']     = 'Transfer Barang PO - Inventory';
        $data['po_item']        = $this->model_po->getDetailPoItem($id);
        $data['po_transfer']    = $this->model_po->getLastItem($pref);

        $this->load->view('header');
        $this->load->view('po_transfer', $data);
        $this->load->view('footer');   
    }

    function transferToBarang(){
        $kode       = $this->input->post('barangKode[]');
        $kategori   = $this->input->post('barangKategori[]');
        $quantity   = $this->input->post('barangQty[]');
        $hargabeli  = $this->input->post('barangHargaBeli[]');
        $hargajual  = $this->input->post('barangHargaJual[]');
        $timestamp  = $this->input->post('barangCreatedat[]');
        $creator    = $this->input->post('barangCreatedby[]');
        $data       = array();

        for($i = 0; $i < count($kode); $i++){
            $data[$i] = array(
                            'barang_kode'       =>  $kode[$i],
                            'barang_bargori_id' =>  $kategori[$i],
                            'barang_qty'        =>  $quantity[$i],
                            'barang_harga_beli' =>  $hargabeli[$i],
                            'barang_harga_jual' =>  $hargajual[$i],
                            'barang_createdat'  =>  $timestamp[$i],
                            'barang_createdby'  =>  $creator[$i]
                        );
        }
        $this->model_po->create('barang_data', $data[$i]);
        redirect('po');
    }
}
