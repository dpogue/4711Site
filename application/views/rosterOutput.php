<div class="body">
    <h2><?php print $title ?></h2>
    <div class="data-description">
        <dl>
            <dt>Sort By:</dt><dd><?php print $filter_options['sortby']; ?></dd>
        </dl>
        <a href="/roster">ReOrder</a>
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
                    <td><?php print $player->Height; ?></td>
                    <td><?php print $player['shoots']; ?></td>
                    <td><?php print $player->BirthPlace; ?></td>
                    <td><?php print $player->DOB; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
