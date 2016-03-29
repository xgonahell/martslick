<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('currency_format')){
    function currency_format($number){
        return ''.number_format($number,0,',','.');
    }
}