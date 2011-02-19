<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Roster extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * Main Entry point of controller
     * calls the view. calls function to load roster
     * @author Warren Voelkl
     */
    function index() {
        $this->load->helper('form');
        $data = array();
        $data['pagetitle'] = 'New York Islanders [COMP4711]';
        $data['pagebody'] = 'roster.php';
        $data['title'] = "NYI Roster";
        $data['xml'] = loadRosterData($this->input->post('order'));
        $this->load->view('template', $data);
    }

}

/**
 * loads an array from an xml file.
 * then sorts the entries by the type selected.
 * @author Warren Voelkl
 */
function loadRosterData($orderBy) {
    $output = array();
    $file = "data/roster.xml";
    $fp = fopen($file, "r");
    $nonparsedfile = fread($fp, 80000);
    $xml = new SimpleXMLElement($nonparsedfile);
    $i = 0;
    foreach ($xml->player as $player) {
        $output[$i]['name'] = $player['name'];
        $output[$i]['position'] = $player['position'];
        $output[$i]['number'] = $player['number'];
        $output[$i]['weight'] = $player['Weight'];
        $output[$i]['shoots'] = $player['Shoots'];
        $output[$i]['BirthPlace'] = $player->BirthPlace;
        $output[$i]['DOB'] = $player->DOB;
        $output[$i]['Height'] = $player->Height;
        $i += 1;
    }
    if (isset($orderBy)) {
        switch ($orderBy) {
            case "name":
                usort($output, 'sortByName');
                break;
            case "number":
                usort($output, 'sortByNumber');
                break;
            case "position":
                usort($output, 'sortByPosition');
                
        }
    }
    return $output;
}

/**
 * Sorts the roster by jersey number.
 * @author Warren Voelkl
 */
function sortByNumber($a, $b) {
    return $a['number'] - $b['number'];
}

/**
 * Sorts the roster by jersey number.
 * @author Warren Voelkl
 */
function sortByName($a, $b) {
    return strcmp($a['name'], $b['name']);
}

/**
 * Sorts the roster by jersey number.
 * @author Warren Voelkl
 */
function sortByPosition($a, $b) {
    if($a['position'] == $b['position'])
        return $a['number'] - $b['number'];
    return strcmp($a['position'], $b['position']);
}

/* End of file roster.php */
/* Location: ./application/controllers/roster.php */

