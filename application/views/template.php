<?php
/*
 * HTML page layout template
 */
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $pagetitle; ?></title>
    <script src="/assets/modernizr-1.6.min.js" type="text/javascript"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
    <script src="//connect.facebook.net/en_US/all.js#xfbml=1"></script>
    <link href="/assets/style.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Droid+Serif:bold" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold,italic" rel="stylesheet" type="text/css">
    <link href="/favicon.ico" rel="icon shortcut" type="image/x-icon">
</head>
<body>
<?php $this->load->view("_header"); ?>
    <div id="wrapper">
        <section>
<?php $this->load->view($pagebody); ?>
        </section>
        <aside>
<?php $this->load->view("_navbar"); ?>
        </aside>
        <footer>
<?php $this->load->view("_footer"); ?>
        </footer>
    </div>
</body>
</html>
