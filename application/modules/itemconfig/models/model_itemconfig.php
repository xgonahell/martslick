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
class model_itemconfig extends CI_Model{

    var $table = 'barang_kategori';
    var $column = array('bargori_nama','bargori_prefix');
    var $order = array('bargori_id' => 'desc');

    var $tableMerk  = 'barang_merk';
    var $columnMerk = array('barmerk_nama','barmerk_prefix');
    var $orderMerk  = array('bargori_id' => 'desc');

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function create($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function getAll($table){
        return $this->db->get($table)->result();
    }

    function deleteByID($table, $data){
        $this->db->delete($table,$data);
    }

    function updateByID($id, $data, $table){
        $this->db->where('bargori_id', $id);
        $this->db->update($table, $data);
        return TRUE;
    }

// PROSES KATEGORI //
    function _get_datatables_query(){
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

    public function get_by_kode($bargori_id){
        $this->db->from($this->table);
        $this->db->where('bargori_id',$bargori_id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($bargori_id){
        $this->db->where('bargori_id', $bargori_id);
        $this->db->delete($this->table);
    }
// PROSES KATEGORI //

// PROSES MERK //
    function _get_datatables_query_merk(){
        $this->db->from($this->tableMerk);
        $i = 0;
    
        foreach ($this->columnMerk as $item){
            if($_POST['search']['value'])
                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $column[$i] = $item;
            $i++;
        }
        
        if(isset($_POST['order'])){
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->orderMerk)){
            $order = $this->orderMerk;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_merk(){
        $this->_get_datatables_query_merk();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_merk(){
        $this->_get_datatables_query_merk();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_merk(){
        $this->db->from($this->tableMerk);
        return $this->db->count_all_results();
    }

    public function get_by_kode_merk($barmerk_id){
        $this->db->from($this->tableMerk);
        $this->db->where('barmerk_id',$barmerk_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function save_merk($data){
        $this->db->insert($this->tableMerk, $data);
        return $this->db->insert_id();
    }

    public function update_merk($where, $data){
        $this->db->update($this->tableMerk, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id_merk($barmerk_id){
        $this->db->where('barmerk_id', $barmerk_id);
        $this->db->delete($this->tableMerk);
    }
 // PROSES MERK //
}
