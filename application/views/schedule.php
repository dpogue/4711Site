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

  <div class="data-description">
    <a href="#" onclick="$('#schedule').attr('src', '/schedule/display/upcoming'); return false;">View upcoming games</a>
    &nbsp;&bull;&nbsp;
    <a href="#" onclick="$('#schedule').attr('src', '/schedule/display/old'); return false;">View past games</a>
    &nbsp;&bull;&nbsp;
    <a href="#" onclick="$('#schedule').attr('src', '/schedule/display/all'); return false;">View all games</a>
  </div>

  <iframe id="schedule" src="/schedule/display/all" width="640" scrolling="no" seamless></iframe>
  <script>
    $('#schedule').contents().find('body').css({"min-height": "100%", "overflow" : "hidden"});
    setInterval("$('#schedule').height($('#schedule').contents().find('body').height())", 1);
  </script>
</div>
