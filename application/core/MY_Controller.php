<?php

class Exception404 extends Exception {
    
}

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $CI = & get_instance();
        $CI->load->model('menu_control_model');
        $CI->load->model('system_model');
        @define("MENU_LIST", $CI->menu_control_model->load_menu());
        @define("THEME", $CI->system_model->get_sys_val('selected_theme'));
    }

    public function _remap($method, $params = array()) {
        $CI = & get_instance();

        if (!is_null($this->session->userdata('user_username'))) {
            if ($this->session->userdata('user_username') == "") {
                redirect(base_url() . "login");
            }
        } else {
            redirect(base_url() . "login");
        }

        try {
            if (!method_exists($this, $method)) {
                throw new Exception404();
            } else {
                if ($CI->uri->segment(1) != "") {
                    if ($CI->module_model->checkGroupAccess($this->session->userdata('user_group_kode'), $CI->uri->segment(1)) == 0) {
                        if ($CI->module_model->checkModule($CI->uri->segment(1)) != 0) {
                            $CI->output->set_status_header('404');
                            $this->show_404();
                        } else {
                            return call_user_func_array(array($this, $method), $params);
                        }
                    } else {
                        $CI->output->set_status_header('404');
                        $this->show_404();
                    }
                } else {
                    return call_user_func_array(array($this, $method), $params);
                }
            }
        } catch (Exception404 $e) {
            $this->show_404();
        }
    }

    protected function show_404() {
        $this->output->set_output('');
        $this->output->set_status_header('404');
        $data['page_title'] = "Page not found";
        $this->load->view('v404.php', $data);
    }

}
