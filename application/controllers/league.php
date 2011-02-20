<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class League extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * Index page for the league.
     * By default sort the teams by conference/division.
     *
     * @author Darryl Pogue
     */
    function index() {
        /* Try to load the league XML file */
        $filename = 'data/league.xml';
        if (!file_exists($filename)) {
            error_log(print_r("File not found: $filename", 1), 0);
            $data['content']['body'] = "<pre>Cannot lead resource: $filename</pre>";

            return;
        }

        $xml = simplexml_load_file($filename);

        /* Render it */
        $this->render($xml, 'conf');
    }

    /**
     * Page to display teams alphabetically.
     *
     * @author Darryl Pogue
     */
    function alpha() {
        /* Try to load the league XML file */
        $filename = 'data/league.xml';
        if (!file_exists($filename)) {
            error_log(print_r("File not found: $filename", 1), 0);
            $data['content']['body'] = "<pre>Cannot lead resource: $filename</pre>";

            return;
        }

        $xml = simplexml_load_file($filename);

        /* Render it */
        $this->render($xml, 'alpha');
    }

    /**
     * Page to display the teams sorted by conference and division.
     *
     * @author Darryl Pogue
     */
    function conf() {
        /* Try to load the league XML file */
        $filename = 'data/league.xml';
        if (!file_exists($filename)) {
            error_log(print_r("File not found: $filename", 1), 0);
            $data['content']['body'] = "<pre>Cannot lead resource: $filename</pre>";

            return;
        }

        $xml = simplexml_load_file($filename);

        /* Render it */
        $this->render($xml, 'conf');
    }

    /**
     * Parse the XML data and render it to the view.
     *
     * @param xml The simplexml document.
     * @param sort The sorting type.
     * @author Darryl Pogue
     */
    private function render($xml, $sort) {
        $teams = array();
        $western = array('Pacific' => array(),
                         'Northwest' => array(),
                         'Central' => array());

        $eastern = array('Southeast' => array(),
                         'Northeast' => array(),
                         'Atlantic' => array());

        /* Iterate over each team */
        foreach ($xml->group as $grp) {
            $code = (string)$grp['code'];
            $city = (string)$grp->city;
            $fullname = $city.' '.(string)$grp->team;

            $conf = (string)$grp->team['conf'];
            $div = (string)$grp->team['div'];

            $link = '';
            if (@count($grp->members->children())) {
                $link = 'http://'.$code.'.bcitxml.com/';
            }

            $members = array();
            foreach ($grp->members->member as $mem) {
                $nbits = explode(',', (string)$mem);
                $n = $nbits[1].' '.$nbits[0];

                $members[] = $n;
            }

            $teams[$code] = array(
                'name' => $fullname,
                'city' => $city,
                'members' => $members,
                'link' => $link);

            /* Store the team ID in the right conference/division array */
            if (!strcmp($conf, 'Western')) {
                $western[$div][] = $code;
            } else if (!strcmp($conf, 'Eastern')) {
                $eastern[$div][] = $code;
            }
        }

        /* Build the data array and pass it to the view */
        $data = array();
        $data['teams'] = $teams;
        $data['sort'] = $sort;
        $data['confs'] = array('Western' => $western,
                               'Eastern' => $eastern);
        $data['pagetitle'] = 'League - New York Islanders [COMP4711]';
        $data['pagebody'] = 'league';
        $this->load->view('template',$data);
    }
}

