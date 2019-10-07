<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
            $link = $_SERVER['PHP_SELF'];
            $link = $link."#comeHere";
            echo "<meta http-equiv='refresh' content='3'; url='$link'>"
        ?>
        <title>Display Date and Time in Javascript</title>
        <script type="text/javascript" src="date_time.js"></script>
    </head>
    <body>
            <span id="date_time"></span>
            <script type="text/javascript">window.onload = date_time('date_time');</script>
            <?php

            $fh = fopen('test.txt','r');
            while ($line = fgets($fh)) {
            // <... Do your work with the line ...>
            echo($line);
            echo("<br />");
            }
            fclose($fh);
            ?>
            <div id="comeHere"></div> <!-- ရောက်ရာအရပ်မှ ဒီနေရာသို့ အမြန်ဆုံး ကြွလာပါရန် 😬😬😬 -->
    </body>
</html>