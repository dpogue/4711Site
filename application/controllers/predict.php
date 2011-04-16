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
        $count = 0;

        $team = str_replace('_', ' ', $team);

        $doc = new DOMDocument();
        $doc->load($filepath);
        $path = new DOMXPath($doc);

        $q = '//away[. = "'.$team.'"]';
        foreach ($path->query($q) as $n) {
            $oppscore += (int)$n->getAttribute('score');
            $tmp = $n;
            while ($tmp->nextSibling->nodeType !== XML_ELEMENT_NODE) {
                $tmp = $tmp->nextSibling;
            }
            $selfscore += (int)$tmp->nextSibling->getAttribute('score');

            $count += 1;
        }

        $q = '//home[. = "'.$team.'"]';
        foreach ($path->query($q) as $n) {
            $selfscore += (int)$n->getAttribute('score');
            $tmp = $n;
            while ($tmp->previousSibling->nodeType !== XML_ELEMENT_NODE) {
                $tmp = $tmp->previousSibling;
            }
            $oppscore += (int)$tmp->previousSibling->getAttribute('score');

            $count += 1;
        }

        if ($count == 0) {
            echo '';
            return;
        }

        $selfscore = ceil($selfscore / $count);
        $oppscore = ceil($oppscore / $count);

        echo '{"team":"'.$team.'","us":'.$selfscore.',"them":'.$oppscore.'}';
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

