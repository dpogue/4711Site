<div class="body">
  <h2><?php print $pagetitle?></h2>
  <div class="data-description">
    <a href="/schedule/upcoming">View upcoming games</a>
    &nbsp;&bull;&nbsp;
    <a href="/schedule/past">View past games</a>
    &nbsp;&bull;&nbsp;
    <a href="/schedule">View all games</a>
  </div>
  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Visitor</th>
        <th>Home</th>
        <th>Time</th>
        <th>Results</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($games as $game) : ?>
      <tr>
        <td><?php print $game['date_nice']; ?></td>
        <td><?php print ucwords(strtolower($game['visitor'])); ?></td>
        <td><?php print ucwords(strtolower($game['home'])); ?></td>
        <td><?php print $game['time']; ?></td>
        <td><?php print ucwords(strtolower($game['results'])); ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
