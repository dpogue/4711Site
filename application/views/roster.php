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

<div class="body">
    <h2><?php print $title; ?></h2>
    <div class="data-description">
        <a href="/">ReOrder</a>
    </div>
    <table>Roster
        <thead>
            <tr>
                <td>Name</td>
                <td>Jersey Number</td>
                <td>Position</td>
                <td>Weight</td>
                <td>Height</td>
                <td>Shoots</td>
                <td>BirthPlace</td>
                <td>Date of Birth</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($xml as $player) : ?>
                <tr>
                    <td><?php print $player['name']; ?></td>
                    <td><?php print $player['number']; ?></td>
                    <td><?php print $player['position']; ?></td>
                    <td><?php print $player['weight']; ?></td>
                    <td><?php print $player['Height']; ?></td>
                    <td><?php print $player['shoots']; ?></td>
                    <td><?php print $player['BirthPlace']; ?></td>
                    <td><?php print $player['DOB']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
