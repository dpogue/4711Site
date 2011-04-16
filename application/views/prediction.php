<?php
/* 
 * Prediction view
 */
?>
<h2>Score Predictions</h2>
<p>
Select the team you would like predict a match against:
<form>
    <select id="teams" onchange="askScore(this);">
        <?php echo $teams; ?>
    </select>
</form>
</p>
<div id="scoreresult">
</div>
<p>
<fb:like href="nyi.bcitxml.com/predict" show_faces="true" width="450" font=""></fb:like>
</p>
<script>
function askScore(sel) {
    var team = sel.options[sel.selectedIndex].value;

    $.ajax({
        url: '/predict/prediction/'+team,
        type: "GET",
        async: true,
        success: showscore
    });
}
function showscore(msg) {
    $('#scoreresult').html(msg);
}
</script>
