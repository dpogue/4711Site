<div class="body">
  <h2><?php print $pagetitle?></h2>
  <?php print form_open('/schedule/update'); ?>
  <div class="form-group-set-source-url">
    <?php print form_label('URL:', 'schedule_url'); ?>
    <?php print form_input('schedule_url', $default_url); ?>
  </div>

  <?php print form_submit('update', 'Show schedule'); ?>
</div>


