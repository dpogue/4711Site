<?php
/* 
 * Prediction view
 */
?>
<h2>Score Predictions</h2>
<p>
<form>
    Select the team you would like predict a match against:
    <select id="teams" onchange="askScore(this);">
        <option>Select a Team</option>
        <?php echo $teams; ?>
    </select>
</form>
</p>
<div id="scoreresult">
</div>
<p>
<br>
<fb:like href="nyi.bcitxml.com/predict" show_faces="true" width="450" font=""></fb:like>
</p>
<script>
function askScore(sel) {
    var team = encodeURIComponent(sel.options[sel.selectedIndex].value);

    $.ajax({
        url: '/predict/prediction/'+team,
        type: "GET",
        async: true,
        success: showscore
    });
}
function showscore(msg) {
    var ret = $.parseJSON(msg);
    $('#scoreresult').html("Playing against " + ret.team + " we predict the score to be NY Islanders: " + ret.us + "; " + ret.team + ": " + ret.them + ".");
}
</script>
