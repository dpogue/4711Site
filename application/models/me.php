<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Me
 *
 * @author warren
 */
class Me extends CI_Model {

    function Get() {
       $data = array(
           'first' => 'warren',
           'last' => 'voelkl',
           'email' => 'warren_voelkl@hotmail.com'
           );
       return $data;

    }
    //put your code here
}
?>

<?php

class MContacts extends CI_Model {

    function addContact(){
        $now = date("Y-m-d H:i:s");
        $data = array(
            'name' => $this->input->xss_clean($this->input->post('name')),
            'email' => $this->input->xss_clean($this->input->post('email')),
            'notes' => $this->input->xss_clean($this->input->post('notes')),
            'ipaddress' => $this->input->ip_address(),
            'stamp' => $now
            );
            $this->db->insert('contacts', $data);
    }
}
?>