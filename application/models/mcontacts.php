<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mcontacts
 *
 * @author warren
 */
class MContacts extends CI_Model {
    function Mcontacts() {
        parent::CI_Model();
    }
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
