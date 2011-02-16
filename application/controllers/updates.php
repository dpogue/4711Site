<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Updates extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data = array();
        $data['pagetitle'] = 'New York Islanders [COMP4711]';
        $data['pagebody'] = 'placeholder';
        $this->load->view('template',$data);
    }

}
