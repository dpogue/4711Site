<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schedule extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * Prepare the schedule section's default landing page.
     *
     * @author Tom Nightingale
     */
    function index() {
      $this->load->helper('form');
      $filepath = "data/CACHED-remote-schedule.xml";
      //$url = "http://mysportscal.com/Files_iCal_CSV/CSV_NHL_2010-2011/new_york_islanders.csv";
      $url = "https://gist.github.com/raw/920858/9fed1999871e41f9776f04a1bd405e052ec2625a/NYI";
      $data = array();
      $data['pagetitle'] = 'Winter 2010/2011 Schedule';
      $data['pagebody'] = 'schedule';

      $post_url = $this->input->post('schedule_url');
      if (!empty($post_url)) $this->update($post_url, $filepath);

      $data['data']['url'] = $url; 

      /*if (file_exists($filepath)) {
        if (($file = fopen($filepath, "r")) === FALSE) {
          show_error("Could not load schedule source file: $filepath");
          return;
        }
        $xml = fread($file, 65536);
        $data['data']['xml'] = "<pre>" . htmlentities($xml) . "</pre>";
      }*/

      $this->load->view('template', $data);
    }

    /**
     * Updates the cached XML datafile.
     *
     * @param $url The location of the source csv data file.
     * @param $filepath The path to write the cache to.
     *
     * @author Tom Nightingale
     */
    private function update($url, $filepath) {
      $xml = $this->loadXML($url);
      if (($handle = fopen($filepath, 'w')) !== FALSE) {
        fwrite($handle, $xml);
        fclose($handle);
      }
    }

    /**
     * Loads a csv file from a file path or url and parses it into a well-formed
     * XML document.
     *
     * @param $url The URL or file path of the source csv file to load.
     *
     * @author Tom Nightingale
     */
    private function loadXML($url) {
      $output = "";
      $output .= "<?xml version=\"1.0\"?>\n";
      $output .= "<schedule>\n";

      if (($handle = fopen($url, "r")) !== FALSE) {
        
        // Loop over each row in the csv and generate a <game> element.
        $count = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          // Skip the header row in csv file.
          if ($count++ == 0) continue;

          $timestamp = strtotime($data[0]);
          $game['day'] = date("j", $timestamp);
          $game['month'] = strtoupper(date("M", $timestamp));
          $game['year'] = date("Y", $timestamp);
          $game['time'] = date("H:i", strtotime($data[6]));
          $game['away'] = $data[13];
          $game['home'] = $data[14];
          $game['score']['away'] = $data[15];
          $game['score']['home'] = $data[16];

          $this->render($output, $game);
        }
        
        fclose($handle);
      }

      $output .= "</schedule>\n";

      return $output;
    }

    /**
     * Render a <game> row in the xml file.
     *
     * @author Tom Nightingale
     */
    private function render(&$output, $data) {
      $output .= "\t<game ";
      $output .= "day=\"{$data['day']}\" ";
      $output .= "month=\"{$data['month']}\" ";
      $output .= "year=\"{$data['year']}\" ";
      $output .= "time=\"{$data['time']}\" ";
      $output .= ">\n";

      $output .= "\t\t<away ";
      $output .= "score=\"{$data['score']['away']}\" ";
      $output .= ">";
      $output .= $data['away'];
      $output .= "</away>\n";

      $output .= "\t\t<home ";
      $output .= "score=\"{$data['score']['home']}\" ";
      $output .= ">";
      $output .= $data['home'];
      $output .= "</home>\n";

      $output .= "\t</game>\n";
    }

    /**
     * Display the XML formatted according to the XSL stylesheet.
     *
     * @author Darryl Pogue
     */
    function display() {
        $order = $this->uri->segment(3, '');

        $XSL = new DOMDocument();
        $XSL->load('./data/schedule.xsl');

        $xslt = new XSLTProcessor();
        $xslt->importStylesheet($XSL);

        $sched = new DOMDocument();
        $sched->load('./data/CACHED-remote-schedule.xml');

        $xslt->setParameter('', 'order', $order);
        $xslt->setParameter('', 'day', date('j'));
        $xslt->setParameter('', 'month', strtoupper(date('M')));
        $xslt->setParameter('', 'year', 2011);

        echo $xslt->transformToXML($sched);
    }
}

?>
