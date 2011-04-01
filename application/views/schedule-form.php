<div class="body">
  <h2><?php print $pagetitle?></h2>

  <div class="update-form">
    <?php print form_open('/schedule'); ?>
    <fieldset class="form-group-set-source-url">
      <?php print form_label('URL:', 'schedule_url'); ?>
      <?php print form_input('schedule_url', $data['url']); ?>
    </fieldset>

    <?php print form_submit('update', 'Show schedule'); ?>
    <?php print form_close(); ?>
  </div>

  <?php if (isset($data['xml'])) : ?>
  <div class="schedule-data">
    <?php print $data['xml']; ?>
  </div>
  <?php endif; ?>

</div>


