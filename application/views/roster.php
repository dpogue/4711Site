<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

echo form_open('roster');
$order = array('name'=> 'name', 'number'=> 'number', 'position'=> 'position');
echo form_dropdown('order', $order);
echo form_submit('mysubmit', 'Submit');
echo form_close();
?>

<?php //print $xml->xslprocessor->transformToXML( $xml->xmldoc );
print $xslsheet->transformToXML($xmldoc);
?>