<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_itemlist
 *
 * @author cornnuclear
 */
class model_transaksi extends CI_model{

    var $table = 'transaksi';
    var $column = array(
                                'transaksi_invoice',
                                'transaksi_date',
                                'transaksi_payment',
                                'transaksi_pelanggan',
                                'transaksi_total_bayar'
                            );
    var $order = array('transaksi_invoice' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    function createData($table, $data){
        $this->db->insert($table, $data);
    }

    function getAllData($table){
        return $this->db->get($table)->result();
    }

    function deleteData($table, $data){
        $this->db->delete($table,$data);
    }

    function updateData($table,$data,$field_key){
        $this->db->update($table,$data,$field_key);
    }

    public function get_by_kode($transaksi_invoice){
        $this->db->from($this->table);
        $this->db->where('transaksi_invoice',$transaksi_invoice);
        $query = $this->db->get();

        return $query->row();
    }

    function get_datatables(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function getLastInvoiceCode(){
        $q = $this->db->query("select MAX(RIGHT(transaksi_invoice,3)) as codeMax from transaksi");
        $code = "";
        $year = substr(date("Y"), -2);
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->codeMax)+1;
                $code = sprintf("%04s", $tmp);
            }
        }else{
            $code = "0001";
        }
        if ($this->session->userdata('role') == 'Super Admin' || $this->session->userdata('role') == 'Admin Gudang'){
            return "INVD".$year.$code;
        }else{
            return "INVS".$year.$code;
        }
    }

    function getAllTransaksiCash(){
        return $this->db->query("SELECT
            a.transaksi_id,
            a.transaksi_invoice,
            a.transaksi_date,
            a.transaksi_payment,
            a.transaksi_total_bayar,
            (select sum(tradetail_qty_item) as jum from transaksi_detail where tradetail_invoice_kode=a.transaksi_invoice) as jumlah
            from transaksi a where a.transaksi_payment='Cash'
            ORDER BY a.transaksi_date DESC
        ")->result();
    }

    function getAllTransaksiPiutang(){
        return $this->db->query("SELECT
            a.transaksi_id,
            a.transaksi_invoice,
            a.transaksi_date,
            a.transaksi_payment,
            a.transaksi_total_bayar,
            (select sum(tradetail_qty_item) as jum from transaksi_detail where tradetail_invoice_kode=a.transaksi_invoice) as jumlah
            from transaksi a where a.transaksi_payment='Utang'
            ORDER BY a.transaksi_date DESC
        ")->result();
    }

    function getKurangStok($barang_kode,$kurangi){
        $q = $this->db->query("select barang_qty from barang where barang_kode='".$barang_kode."'");
        $barang_qty = "";
        foreach($q->result() as $d){
            $barang_qty = $d->barang_qty - $kurangi;
        }
        return $barang_qty;
    }

    function getKurangStokToko($barang_kode,$kurangi){
        $q = $this->db->query("select barang_qty_toko from barang where barang_kode='".$barang_kode."'");
        $barang_qty_toko = "";
        foreach($q->result() as $d){
            $barang_qty_toko = $d->barang_qty_toko - $kurangi;
        }
        return $barang_qty_toko;
    }    

    function getTransaksiByID($id){
        $q = $this->db->query("select * from transaksi where transaksi_invoice='$id'")->row();
        return $q;
    }

    function getTransaksiDetailByInv($id){
        return $this->db->query("
            select a.tradetail_barang_kode, a.tradetail_barang_jenis, a.tradetail_qty_item, a.tradetail_diskon, a.tradetail_harga_barang_diskon
            from transaksi_detail a
            left join transaksi b on a.tradetail_invoice_kode=b.transaksi_invoice
            where a.tradetail_invoice_kode='$id'
        ")->result();
    }

    function getReportPenjualan($fromDate, $toDate){
        $q = $this->db->query("SELECT 
                                a.transaksi_invoice,
                                a.transaksi_pelanggan,
                                a.transaksi_total_bayar,
                                a.transaksi_payment,
                                a.transaksi_date,
                                (select sum(tradetail_qty_item) as total_beli_barang from transaksi_detail
                                where tradetail_invoice_kode=a.transaksi_invoice) as jumlah_barang
                                FROM transaksi a
                                WHERE a.transaksi_date between '$fromDate' and '$toDate'
                                and a.transaksi_payment = 'Cash'
                            ");
        return $q->result();
    }

    function getTotalPendapatan($fromDate, $toDate){
        $t = $this->db->query("SELECT SUM(transaksi_total_bayar) as tot from transaksi
                                where transaksi_date between '$fromDate' and '$toDate'
                                and transaksi_payment = 'Cash'
                            ");
        return $t->row();
    }

    function getReportPiutang($fromDate, $toDate){
        $q = $this->db->query("SELECT 
                                a.transaksi_invoice,
                                a.transaksi_pelanggan,
                                a.transaksi_total_bayar,
                                a.transaksi_payment,
                                a.transaksi_date,
                                (select sum(tradetail_qty_item) as total_beli_barang from transaksi_detail
                                where tradetail_invoice_kode=a.transaksi_invoice) as jumlah_barang
                                FROM transaksi a
                                WHERE a.transaksi_date between '$fromDate' and '$toDate'
                                and a.transaksi_payment = 'Utang'
                            ");
        return $q->result();
    }

    function getTotalPiutang($fromDate, $toDate){
        $t = $this->db->query("SELECT SUM(transaksi_total_bayar) as tot from transaksi
                                where transaksi_date between '$fromDate' and '$toDate'
                                and transaksi_payment = 'Utang'
                            ");
        return $t->row();
    }

    function editDataPiutang($id, $data, $table){
        $this->db->where('transaksi_id', $id);
        $this->db->update($table, $data);
        return TRUE;
    }
}