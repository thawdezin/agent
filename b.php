
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>


        <title>Display Date and Time in Javascript</title>
        <script type="text/javascript" src="date_time.js"></script>
    </head>
    <body>
            <span id="date_time"></span>
            <script type="text/javascript">window.onload = date_time('date_time');</script>

    </body>
</html>

<!-- <?php
session_start();
if(isset($_SESSION['ok'])){
    $evn_n = $_REQUEST['env_name'];
    $spi = $_REQUEST['spider_name'];
    $logName = $_REQUEST['log_name'];
    $projLoc = $_REQUEST['proj_loc'];
    echo $evn_n;
    echo "<br />";
    echo $spi;
    echo "<br />";
    echo $logName;
    echo "<br />";
    echo $projLoc;
}
else{
    header("Location:b.php");
    session_destroy();
}

?> -->