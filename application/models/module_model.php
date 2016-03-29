<?php

class module_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function checkModule($module_name = '') {
        $r = $this->db->query("select count(*) as cnt, module_active_flag from module WHERE module_controller = '" . $module_name . "'");
        if ($r->row()->cnt = 0) {
            return 1;
        } else {
            if ($r->row()->module_active_flag == 0) {
                return 2;
            } else {
                return 0;
            }
        }
    }

    function checkGroupAccess($group_id = '', $module_name = '') {
        $r = $this->db->query("select count(*) as cnt, b.status from module a
        left join user_group_access b on b.module_id = a.module_id
        where b.usergroup_id = '$group_id' and a.module_controller = '$module_name'");
        if ($r->row()->cnt = 0) {
            return 1;
        } else {
            if($r->row()->status != '1')
            {
                return 2;
            }
            else
            {
                return 0;
            }
        }
    }

}
