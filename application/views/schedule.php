<div class="body">
  <h2><?php print $pagetitle?></h2>
  <div class="data-description">
    <p>You searched for flights that match the following conditions:</p>
    <a href="/schedule/upcoming">View upcoming games</a>
    <a href="/schedule/past">View past games</a>
    <a href="/schedule">View all games</a>
  </div>
  <table>
    <thead>
      <tr>
        <td>Date</td>
        <td>Visitor</td>
        <td>Home</td>
        <td>Time</td>
        <td>Results</td>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($games as $game) : ?>
      <tr>
        <td><?php print $game['date_nice']; ?></td>
        <td><?php print $game['visitor']; ?></td>
        <td><?php print $game['home']; ?></td>
        <td><?php print $game['time']; ?></td>
        <td><?php print $game['results']; ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
