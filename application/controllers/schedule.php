<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schedule extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * Prepare the schedule section's default landing page.
     * It will currently contain an unfiltered list of games in febuary.
     *
     * @author Tom Nightingale
     */
    function index() {
        // Load dataset from file if it exists.
        $filename = 'data/schedule-feb.xml';
        if (!file_exists($filename)) {
          error_log(print_r("File not found: $filename", 1), 0);
          $data['content']['body'] = "<pre>Cannot load resource: $filename</pre>";
          // This is not ideal.
          return;
        }
        
        $xml = simplexml_load_file($filename);
        // Filtering dataset.
        $games = filterGames($xml);

        $data = array();
        $data['pagetitle'] = 'February 2011 Schedule';
        $data['games'] = $games;
        $data['pagebody'] = 'schedule';
        $this->load->view('template', $data);
    }

    function update() {
      $url = "http://mysportscal.com/Files_iCal_CSV/CSV_NHL_2010-2011/new_york_islanders.csv";
      $xml = $this->loadXML($url);
      $data['pagetitle'] = 'February 2011 Schedule';
      $data['xml'] = "<pre>" . htmlentities($xml) . "</pre>";
      $data['pagebody'] = 'update';
      $this->load->view('template', $data);
    }

    private function loadXML($url) {
      $output = "";
      $output .= "<?xml version=\"1.0\"?>\n";
      $output .= "<schedule>\n";

      if (($handle = fopen($url, "r")) !== FALSE) {
        
        $count = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          if ($count++ == 0) continue;

          $timestamp = strtotime($data[0]);
          $game['day'] = date("j", $timestamp);
          $game['month'] = strtoupper(date("M", $timestamp));
          $game['year'] = date("Y", $timestamp);
          $game['time'] = date("H:i", strtotime($data[6]));
          $game['away'] = $data[13];
          $game['home'] = $data[14];

          $this->render($output, $game);
        }
        
        fclose($handle);
      }

      $output .= "</schedule>\n";

      return $output;
    }

    private function render(&$output, $data) {
      $output .= "\t<game ";
      $output .= "day=\"{$data['day']}\" ";
      $output .= "month=\"{$data['month']}\" ";
      $output .= "year=\"{$data['year']}\" ";
      $output .= "time=\"{$data['time']}\" ";
      $output .= ">\n";

      $output .= "\t\t<away";
      //$output .= "score=\"{$data[7]}\" ";
      $output .= ">";
      $output .= $data['away'];
      $output .= "</away>\n";

      $output .= "\t\t<home";
      //$output .= "score=\"{$data[8]}\" ";
      $output .= ">";
      $output .= $data['home'];
      $output .= "</home>\n";

      $output .= "\t</game>\n";
    }

    /**
     * Placeholder action for the upcoming games page.
     *
     * @author Tom Nightingale
     */
    function upcoming() {
        // Load dataset from file if it exists.
        $filename = 'data/schedule-feb.xml';
        if (!file_exists($filename)) {
          error_log(print_r("File not found: $filename", 1), 0);
          $data['content']['body'] = "<pre>Cannot load resource: $filename</pre>";
          // This is not ideal.
          return;
        }
        
        $xml = simplexml_load_file($filename);
        // Filtering dataset.
        $games = filterGames($xml, 'from');

        $data = array();
        $data['pagetitle'] = 'February 2011 Schedule - Upcoming Games';
        $data['games'] = $games;
        $data['pagebody'] = 'schedule';
        $this->load->view('template', $data);
    }

    /**
     * Placeholder action for the past games page.
     *
     * @author Tom Nightingale
     */
    function past() {
        // Load dataset from file if it exists.
        $filename = 'data/schedule-feb.xml';
        if (!file_exists($filename)) {
          error_log(print_r("File not found: $filename", 1), 0);
          $data['content']['body'] = "<pre>Cannot load resource: $filename</pre>";
          // This is not ideal.
          return;
        }
        
        $xml = simplexml_load_file($filename);
        // Filtering dataset.
        $games = filterGames($xml, 'before');

        $data = array();
        $data['pagetitle'] = 'February 2011 Schedule - Past Games';
        $data['games'] = $games;
        $data['pagebody'] = 'schedule';
        $this->load->view('template', $data);
    }

}

/**
 * Comparison function for usort(), sorts by game's scheduled time.
 *
 * @author Tom Nightingale
 */
function gameSortTime($a, $b) {
  if ($a['date_stamp'] == $b['date_stamp']) {
    return 0;
  }
  return ($a['date_stamp'] < $b['date_stamp']) ? -1 : 1;
}

/**
 * Function to parse provided SimpleXML object, apply filters and output an array
 * structure of matching games.
 *
 * @author Tom Nightingale
 */
function filterGames($xml, $filter = NULL, $datestamp = NULL) {
  $games = array();

  // Iterate and process each item in the dataset.
  foreach ($xml->game as $game) {
    $skip = FALSE;

    // Get current time as it will probably be useful.
    if (!isset($datestamp)) $datestamp = time();

    // Convert the game date/time into a more useful format.
    $game_datestamp = strtotime("{$game['day']} {$game['month']} {$game['year']}".
                            " {$game['time']}");

    if (isset($filter)) {
      // Performing filter here.
      switch ($filter) {
        case 'before':
          if ($datestamp < $game_datestamp) $skip = TRUE;
          break;
        case 'from':
          if ($datestamp > $game_datestamp) $skip = TRUE;
          break;
      }
    }
    if ($skip) continue;

    // Prepare data array for rendering.
    $row['date_stamp'] = $game_datestamp;
    $row['date_nice'] = date('D d F, Y', $game_datestamp);  
    $row['visitor'] = (string) $game->away;
    $row['home'] = (string) $game->home;
    $row['time'] = date('h:ia', $game_datestamp);

    // If there are results, might aswell format them too.
    $row['results'] = "";
    if (isset($game->home['score']) && isset($game->away['score'])) {
      $row['results'] = "{$game->away} ({$game->away['score']}) | ".
                        "({$game->home['score']}) {$game->home}";
    }

    // Add to list.
    $games[] = $row;
  }

  // Sort earliest games first.
  usort($games, 'gameSortTime');

  return $games;
}

/**
 * Helper debugging function, prints $var to phperror log.
 */
function _p($var, $tag = NULL) {
  if (!isset($tag)) error_log(print_r($var, 1), 0); 
  else error_log(print_r($tag . ": " . $var, 1), 0);
}

?>
