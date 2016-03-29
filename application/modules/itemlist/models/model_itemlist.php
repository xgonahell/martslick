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
class model_itemlist extends CI_Model{
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

    function getPrefixByID($bargori_id){
        $q = $this->db->query(" SELECT bargori_prefix FROM barang_kategori WHERE bargori_id = '".$bargori_id."' ")->row();
    }

    function getLastItemId(){
        $year = substr(date("Y"), -2);
        $kode = $year;
        $q = $this->db->query(" SELECT
                                barang_kategori_prefix,
                                MAX(right(barang_kode,4)) AS codeMax
                                FROM barang_data a
                                WHERE
                                left(barang_kode,3) = barang_kategori_prefix ");

        $code = "";
        if($q->num_rows()>0){
            foreach($q->result() AS $k){
                $tmp = ((int)$k->codeMax)+1;
                $code = sprintf("%04s", $tmp);
            }
        }else{
            $code = "0001";
        }
       
       return $year.$code;
    }
}
