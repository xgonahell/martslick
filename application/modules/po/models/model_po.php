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
class model_po extends CI_Model{

    var $table = 'po_head';
    var $column = array('po_invoice','po_supplier', 'po_status', 'po_status_barang', 'po_createdat');
    var $order = array('po_createdat' => 'desc');

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function create($table, $data){
        $this->db->insert($table, $data);
    }

    function getAll($table){
        return $this->db->get($table)->result();
    }

    function getAllItem($table){
        $this->db->order_by('barang_createdat', 'DESC');
        return $this->db->get($table)->result();
    }

    function deleteByID($table, $data){
        $this->db->delete($table,$data);
    }

    function updateByID($id, $data, $table){
        $this->db->where('barang_kode', $id);
        $this->db->update($table, $data);
        return TRUE;
    }

// PROSES PO //
    function _get_datatables_query(){
        $this->db->order_by('po_createdat', 'DESC');
        $this->db->from($this->table);
        $i = 0;
    
        foreach ($this->column as $item){
            if($_POST['search']['value'])
                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $column[$i] = $item;
            $i++;
        }
        
        if(isset($_POST['order'])){
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
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
// PROSES PO //

    function getPrefixByID($bargori_id){
        $q = $this->db->query(" SELECT bargori_prefix FROM barang_kategori WHERE bargori_id = '".$bargori_id."' ")->row();
    }

    function getAllDataPO(){
        return $q = $this->db->query(" SELECT * from po_head ORDER BY po_createdat DESC ")->result();
    }

    function getLastItemId(){
        $q = $this->db->query("SELECT MAX(RIGHT(po_invoice,3)) as codeMax from po_head");
        $code = "";
        $year = substr(date("Y"), -2);
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->codeMax)+1;
                $code = sprintf("%03s", $tmp);
            }
        }else{
            $code = "001";
        }
        return "PO".$year.$code;
    }

    function getInvoiceItem($po_invoice){
        $q = $this->db->query("SELECT po_createdat, po_invoice, po_total_bayar, po_status, supplier_nama, supplier_alamat, supplier_kota, supplier_hp
                                FROM po_head ph
                                LEFT JOIN supplier spl ON spl.supplier_kode = po_supplier
                                WHERE po_invoice = '$po_invoice'
                            ");
        return $q->row();
    }

    function getDetailPoItem($po_invoice){
        $q = $this->db->query("SELECT
                                po_detail_id,
                                po_invoice,
                                po_detail_merk,
                                po_detail_kategori,
                                barmerk_nama,
                                bargori_nama,
                                bargori_prefix,
                                po_detail_qty,
                                po_detail_price
                                FROM po_detail pd
                                LEFT JOIN barang_merk bm ON bm.barmerk_id = po_detail_merk
                                LEFT JOIN barang_kategori bk ON bk.bargori_id = po_detail_kategori
                                WHERE po_invoice = '$po_invoice'
                            ");
        return $q->result();
    }

    // function getItemCodeJacket(){
    //     $year = substr(date("Y"), -2);
    //     $kode = 'JA'.$year;
    //     $q = $this->db->query("select MAX(MID(barang_kode,5,4)) as codeMax from barang where barang_kode like '".$kode."%'");

    //     $code = "";
    //     if($q->num_rows()>0){
    //         foreach($q->result() as $k){
    //             $tmp = ((int)$k->codeMax)+1;
    //             $code = sprintf("%04s", $tmp);
    //         }
    //     }else{
    //         $code = "0001";
    //     }
       
    //    return $year.$code;
    // }

    function getLastItem($pref){
        $year = substr(date("Y"), -2);
        $kode = $pref.$year;
        $q = $this->db->query("SELECT
                                barang_kode,
                                bargori_prefix,
                                MAX(right(barang_kode,3)) AS codeMax
                                FROM barang_data
                                LEFT JOIN barang_kategori bk ON bk.bargori_id = barang_bargori_id
                                WHERE barang_kode like '".$kode."%'
                            ");
        $code = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->codeMax)+1;
                $code = sprintf("%03s", $tmp);
            }
        }else{
            $code = "001";
        }
       return $pref.$year.$code;
    }
}
