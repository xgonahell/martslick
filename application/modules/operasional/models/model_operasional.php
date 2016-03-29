<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_operasional
 *
 * @author cornnuclear
 */
class model_operasional extends CI_Model{

    var $table = 'operasional';
    var $column = array(
                                'opr_kode',
                                'opr_desc',
                                'opr_nominal'
                            );
    var $order = array('opr_kode' => 'desc');

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

    function getAllItem($table){
        $this->db->order_by('opr_createdat', 'DESC');
        return $this->db->get($table)->result();
    }

    function deleteByID($table, $data){
        $this->db->delete($table,$data);
    }

    function updateByID($id, $data, $table){
        $this->db->where('opr_kode', $id);
        $this->db->update($table, $data);
        return TRUE;
    }

// AJAX FUNCTIONS //
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

    public function get_by_kode($opr_kode){
        $this->db->from($this->table);
        $this->db->where('opr_kode',$opr_kode);
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

    public function delete_by_id($opr_kode){
        $this->db->where('opr_kode', $opr_kode);
        $this->db->delete($this->table);
    }
// AJAX FUNCTIONS //

    function getCodeOperasional(){
        $year = substr(date("Y"), -2);
        $q = $this->db->query("select MAX(RIGHT(opr_kode,3)) as codeMax from operasional");
        $code = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->codeMax)+1;
                $code = sprintf("%04s", $tmp);
            }
        }else{
            $code = "00001";
        }
        return 'OT' .$year .$code;
    }
}
