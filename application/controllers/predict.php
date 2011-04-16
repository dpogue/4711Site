<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Predict extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $teamstring = $this->parseteams();

        $data = array();
        $data['pagetitle'] = 'New York Islanders [COMP4711]';
        $data['pagebody'] = 'prediction';
        $data['teams'] = $teamstring;
        $this->load->view('template',$data);
    }

    function prediction() {
        $team = $this->uri->segment(3, '');
        $oppscore = 0;
        $selfscore = 0;
        $filepath = "data/CACHED-remote-schedule.xml";

        $doc = new DOMDocument();
        $doc->load($filepath);
        $path = new DOMXPath($doc);

        $q = '//away[. = "'.$team.'"]';

        foreach ($path->query($q) as $n) {
            echo $n->getParent()->getAttrbute('day');
        }

        echo $team;
    }

    private function parseteams() {
        $filename = 'data/league.xml';
        if (!file_exists($filename)) {
            error_log(print_r("File not found: $filename", 1), 0);
            $data['content']['body'] = "<pre>Cannot lead resource: $filename</pre>";

            return;
        }

        $xml = simplexml_load_file($filename);
        $ret = '';

        foreach ($xml->group as $grp) {
            if (strcmp((string)$grp['code'], 'nyi') == 0) {
                continue;
            }
            if (strcmp((string)$grp['code'], 'nyr') == 0) {
                $city = 'NY Rangers';
                $ret .= '<option value="'.$city.'">'.$city.'</option>';
                continue;
            }

            $city = (string)$grp->city;
            $ret .= '<option value="'.$city.'">'.$city.'</option>';
        }

        return $ret;
    }
}

