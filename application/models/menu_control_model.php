<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu_control_model
 *
 * @author nightwalker
 */
class menu_control_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getMenu() {
        $q = " SELECT 
                a.module_id, 
                a.module_parent,
                a.module_name, 
                a.module_controller,
                a.module_icon,
                a.module_active_flag,
                (select count(b.module_id) from module b WHERE b.module_parent = a.module_id) as cnt_child
         FROM module a
         WHERE a.module_active_flag = '1'
         order by a.module_parent, a.module_order asc ";
        return $this->db->query($q)->result_array();
    }

    private function build_tree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['module_parent'] == $parentId) {
                $children = $this->build_tree($elements, $element['module_id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    function generate_nav_array($arr, $parent = 0) {
        $pages = Array();
        foreach ($arr as $page) {
            if ($page['module_parent'] == $parent) {
                if (isset($page['children'])) {
                    $page['children'] = $page['children'];
                } else {
                    $this->generate_nav_array($arr, $page['module_id']);
                }
                $pages[] = $page;
            }
        }
        return $pages;
    }

    function generate_nav_html($nav, $ischild = false) {
        $html = '';
        foreach ($nav as $page) {
            if ($page['module_controller'] == "dashboard") {
                $url = base_url();
            } else {
                $url = $page['module_controller'];
            }
            if ($ischild == true) {
                if ($page['cnt_child'] > 0) {
                    $html .='<li>';
                } else {
                    $html .='<li>';
                }
            } else {
                $html .= '<li>';
            }

            if ($page['cnt_child'] > 0 && $page['module_controller'] == "#") {
                $html .= '<li class="menu-list"><a href = "#child_' . $page['module_id'] . '">' . '<i class="'. $page['module_icon'] .'"></i>' . $page['module_name'] . '</a>';
            } else {
                $html .= '<a href="' . $url . '">' . '<i class="'. $page['module_icon'] .'"></i>' . $page['module_name'] .  '</a>';
            }
            //$html .= '<a href="' . $page['module_controller'] . '">' . $page['module_name'] . '</a>';
            if (isset($page['children'])) {

                $html .='<ul class="child-list">';
                $html .= $this->generate_nav_html($page['children'], true);
                $html .='</ul>';
            }

            $html .= '</li>';
        }
        return $html;
    }

    function load_menu() {
        $rows = array();

        $menu_list = $this->getMenu();
        foreach ($menu_list as $ml) {
            $l = array(
                'module_id' => $ml['module_id'],
                'module_parent' => $ml['module_parent'],
                'module_name' => $ml['module_name'],
                'module_controller' => $ml['module_controller'],
                'module_icon'       => $ml['module_icon'],
                'cnt_child' => $ml['cnt_child']
            );
            array_push($rows, $l);
        }
        $nav = $this->build_tree($rows);
        $navarray = $this->generate_nav_array($nav);
        return $this->generate_nav_html($navarray);
    }

}