<div class="body">
    <h2><?php print $title; ?></h2>
    <div class="data-description">
<?php
    echo form_open('roster');
    $order = array('name'=> 'name', 'number'=> 'number', 'position'=> 'position');
    echo 'Sort players by ';
    echo form_dropdown('order', $order);
    echo ' ';
    echo form_submit('mysubmit', 'Sort');
    echo form_close();
?>
    </div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Jersey</th>
                <th>Position</th>
                <th>Weight</th>
                <th>Height</th>
                <th>Shoots</th>
                <th>Birthplace</th>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
