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
class transaksi extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('model_transaksi');
        $this->load->helper('currency_format_helper');
    }

    public function index(){
        $data['page_title']     = "Data Transaksi";
        $data['timestamp']      = date('Y-m-d H:i:s');
        $data['creator']        = $this->session->userdata('user_username');
        $data['dataTransaksi']  = $this->model_transaksi->getAllData('transaksi');

        $this->load->view('header', $data);
        $this->load->view('data_transaksi');
        $this->load->view('footer');
    }
    function TransaksiBaru(){
        $data['page_title'] = "New Transaksi";

        $data['kategori']               = $this->model_transaksi->getAllData('barang_kategori');
//        $data['merk']                 = $this->model_transaksi->getAllData('barang_merk');
        $data['transaksiInvoice']       = $this->model_transaksi->getLastInvoiceCode();
        // $data['kategoriPrefix']      = $this->model_po->getPrefixByID('bargori_id');

        $data['timestamp']  = date('Y-m-d H:i:s');
        $data['creator']    = $this->session->userdata('user_username');

        $this->load->view('header', $data);
        $this->load->view('TransaksiForm');
        $this->load->view('footer');
    }

//TRANSAKSI//

    public function ajax_list(){
        $list = $this->model_transaksi->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $transaksi){
            $no++;
            $row = array();
            $row[] = $transaksi->transaksi_invoice;
            $row[] = $transaksi->transaksi_date;
            $row[] = $transaksi->transaksi_payment;
            $row[] = $transaksi->transaksi_pelanggan;
            $row[] = $transaksi->transaksi_total_bayar;            

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_transaksi('."'".$transaksi->transaksi_invoice."'".')"><i class="fa fa-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="DelTransaksi('."'".$transaksi->transaksi_invoice."'".')"><i class="fa fa-trash"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model_transaksi->count_all(),
                        "recordsFiltered" => $this->model_transaksi->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function ajax_edit($transaksi_invoice){
        $data = $this->model_transaksi->get_by_kode($transaksi_invoice);
        echo json_encode($data);
    }

    function TransaksiAddToCart(){
        $data = array(
            'id'    => $this->input->post('transaksiBarang'),
            'name'  => $this->input->post('transaksiKategoriBarang'),
            'price' => $this->input->post('transaksiHarga'),
            'qty'   => $this->input->post('transaksiQty'),
        );
        $this->cart->insert($data);
        redirect('transaksi/TransaksiBaru');
    }

    function DelFromCart($rowid){
        $data = array(
            'rowid' => $rowid,
            'qty'   => 0
        );
        $this->cart->update($data);
        redirect('transaksi/TransaksiBaru');
    }

    function InsertTransaksi(){
        $data = array(
            'transaksi_invoice'         => $this->input->post('transaksiInvoice'),
            'transaksi_payment'         => $this->input->post('transaksiPayment'),
            'transaksi_pelanggan'       => $this->input->post('transaksiPelanggan'),
            'transaksi_hp_pelanggan'    => $this->input->post('transaksiHpPelanggan'),
            'transaksi_total_bayar'     => $this->input->post('transaksiTotalBayar'),
            'transaksi_operator'        => $this->input->post('transaksiCreator'),
            'transaksi_date'            => $this->input->post('transaksiTimestamp')
        );
        $this->model_transaksi->createData('transaksi', $data);

        foreach($this->cart->contents() as $items){
            $tr_bar_kod = $items['id'];
            $tr_bar_jen = $items['name'];
            $tr_bar_har = $items['price'];
//            $tr_bar_har_dis = $items['price'] - $items['options']['diskon']/100 * $items['price'];
            $tr_qty = $items['qty'];
//            $tr_dis = $items['options']['diskon'];
/*            $data_detail = array(
                'tradetail_invoice_kode'            => $this->input->post('transaksiInvoice'),
                'tradetail_barang_kode'             => $tr_bar_kod,
                'tradetail_barang_jenis'            => $tr_bar_jen,
                'tradetail_harga_barang_asli'       => $tr_bar_har,
                'tradetail_harga_barang_diskon'     => $tr_bar_har_dis,
                'tradetail_qty_item'                => $tr_qty,
                'tradetail_diskon'                  => $tr_dis,
                'tradetail_date'                    => $this->input->post('transaksiTanggal')
            );
            $this->model_transaksi->createData('transaksi_detail', $data_detail);
            print_r($data_detail);
            if ($this->session->userdata('role') == 'Super Admin' || $this->session->userdata('role') == 'Admin Gudang'){
                $update['barang_qty'] = $this->model_transaksi->getKurangStok($tr_bar_kod,$tr_qty);
                $key['barang_kode'] = $tr_bar_kod;
                $this->model_transaksi->updateData('barang',$update,$key);
            }else{
                $update['barang_qty_toko'] = $this->model_transaksi->getKurangStokToko($tr_bar_kod,$tr_qty);
                $key['barang_kode'] = $tr_bar_kod;
                $this->model_transaksi->updateData('barang',$update,$key);                
            }*/
        }
        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
        redirect ('transaksi/index');
    }

/*    function TransaksiDetail(){
        $id = $this->uri->segment(3);
        $data = array(
            'data_transaksi'    => $this->model_transaksi->getTransaksiByID($id),
            'data_tradetail'    => $this->model_transaksi->getTransaksiDetailByInv($id),
        );
        $this->load->view('TransaksiDetail', $data);
    }*/

    function DelTransaksi(){
        $id['transaksi_invoice'] = $this->uri->segment(3);
        $this->model_transaksi->deleteData('transaksi', $id);
        $id_detail['tradetail_invoice_kode'] = $this->uri->segment(3);
        $this->model_transaksi->deleteData('transaksi_detail', $id_detail);
        redirect('transaksi/Transaksi');

    }

    function BayarUtangJson(){  
        $data = $this->model_transaksi->getTransaksiByID($this->input->post("id"));
        echo json_encode($data);
    }

    function UpdatePiutang(){
        $id = $this->input->post('transaksiID');
        $data = array(
            'transaksi_payment'     => $this->input->post('transaksiMetodeBayar'),
        );
        $this->model_transaksi->editDataPiutang($id, $data, 'transaksi');
        redirect('transaksi/Transaksi');
    }
}