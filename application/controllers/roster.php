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
        $data['xmldoc'] = new DOMDocument;
        $data['xmldoc']->load('./data/roster.xml');
        $data['xslsheet'] = loadRosterData($this->input->post('order'));
        $this->load->view('template', $data);
    }

}

/**
 * loads the corrent xsl style sheet
 * 
 * @author Warren Voelkl
 */
function loadRosterData($orderBy) {
    $xslt = new XSLTProcessor();
    $XSL = new DOMDocument();
    $XSL->load('./data/rostername.xsl', LIBXML_NOCDATA);
    if (isset($orderBy)) {
        switch ($orderBy) {
            case "name":
                $XSL->load('./data/rostername.xsl', LIBXML_NOCDATA);
                break;
            case "number":
                $XSL->load('./data/rosternumber.xsl', LIBXML_NOCDATA);
                break;
            case "position":
                $XSL->load('./data/rosterposition.xsl', LIBXML_NOCDATA);
        }
    }
    
    $xslt->importStylesheet($XSL);
    return $xslt;
}

/* End of file roster.php */
/* Location: ./application/controllers/roster.php */

