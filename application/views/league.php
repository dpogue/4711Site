<?php function print_team($team) {
    echo '<li><dl><dt>';
    if (!empty($team['link'])) {
        echo '<a href="'.$team['link'].'">';
        echo $team['name'];
        echo '</a>';
    } else {
        echo $team['name'];
    }
    echo '</dt><dd>';
    foreach ($team['members'] as $m) {
        echo $m.'<br>';
    }
    echo '</dd></dl></li>'."\n";
} ?>
<h2>The National Hockey League</h2>
<p class="centre">
    <a href="/league/alpha">Sort teams alphabetically</a>
    &nbsp;&bull;&nbsp;
    <a href="/league/conf">Sort teams by conference &amp; division</a>
</p>
<?php if (!strcmp($sort, 'conf')) : ?>
<section id="western">
  <h2>Western Conference</h2>
  <h3>Pacific</h3>
    <ul>
<?php foreach($confs['Western']['Pacific'] as $t): ?>
      <?php print_team($teams[$t]); ?>
<?php endforeach; ?>
    </ul>
  <h3>Northwest</h3>
    <ul>
<?php foreach($confs['Western']['Northwest'] as $t): ?>
      <?php print_team($teams[$t]); ?>
<?php endforeach; ?>
    </ul>
  <h3>Central</h3>
    <ul>
<?php foreach($confs['Western']['Central'] as $t): ?>
      <?php print_team($teams[$t]); ?>
<?php endforeach; ?>
    </ul>
</section>
<section id="eastern">
  <h2>Eastern Conference</h2>
  <h3>Southeast</h3>
    <ul>
<?php foreach($confs['Eastern']['Southeast'] as $t): ?>
      <?php print_team($teams[$t]); ?>
<?php endforeach; ?>
    </ul>
  <h3>Northeast</h3>
    <ul>
<?php foreach($confs['Eastern']['Northeast'] as $t): ?>
      <?php print_team($teams[$t]); ?>
<?php endforeach; ?>
    </ul>
  <h3>Atlantic</h3>
    <ul>
<?php foreach($confs['Eastern']['Atlantic'] as $t): ?>
      <?php print_team($teams[$t]); ?>
<?php endforeach; ?>
    </ul>
</section>
<?php else : ?>
<section id="league">
<?php foreach ($teams as $t) : ?>
  <?php print_team($t); ?>
<?php endforeach; ?>
</section>
<?php endif; ?>
