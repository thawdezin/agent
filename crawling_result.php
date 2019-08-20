<?php
      session_start();
      if(isset($_SESSION['ok'])){
        session_destroy();
      }
      else{
          header("Location:crawl.php");
          session_destroy();
      }
      ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Mini Agent | Crawl Result </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="css/inuit.css">
<link rel="stylesheet" href="css/fluid-grid16-1100px.css">
<link rel="stylesheet" href="css/eve-styles.css">
<link rel="stylesheet" href="css/formalize.css">
<link rel="shortcut icon" href="icon.png">
<link rel="apple-touch-icon-precomposed" href="img/icon.png">
<script src="js/respond-min.js"></script>
<script src="js/jquery164min.js"></script>
<script src="js/jquery.formalize.min.js"></script>
<script type="text/javascript" src="date_time.js"></script>
<!--[if lte IE 7]>
<style>
hr { display:block; height:1px; border:0; border-top:1px solid #fff; margin:1em 0; padding:0; }
.grid-4{ width:22% }
</style>
<![endif]-->
</head>
<!--===============================================================  Logo, social and menu =====================================================================================-->
<body>
<script type="text/javascript">window.onload = date_time('date_time');</script>
<div class="wrapper"> <a href="index.html" id="logo"><img src="img/logo.png" alt="">
  <h1 class="accessibility"></h1>
  </a>
  <div class="social"> <a href="#"><img src="img/facebook.png" width="20" height="20" alt=""></a> <a href="#"><img src="img/twitter.png" width="20" height="20" alt=""></a> <a href="#"><img src="img/linkedin.png" width="20" height="20" alt=""></a> <a href="#"><img src="img/vcard.png" width="20" height="20" alt=""></a> <a href="#"><img src="img/picasa.png" width="20" height="20" alt=""></a> </div>
  <ul id="nav" class="main">
    <li><a href="index.php">Home</a></li>
    <li><a href="crawl.php" class="active">Crawl</a></li>
    <li><a href="find.php">Find items</a></li>
    <li><a href="framework.php">Framework</a></li>
    <li><a href="https://www.facebook.com/thawdezin">Contact</a></li>
  </ul>
</div>
<!--end of wrapper div-->
<div class="clear"></div>
<!--===============================================================  Left content, address =====================================================================================-->
<div class="wrapper">
  <div class="grids top">
    <div class="grid-6 grid">
      <div class="green bottom">
        
      <h6>Check your previous input in here!</h6>

        <table class="form">
          <tr>
            <th> <label for="env_name"> Anaconda Environment Name </label>
            </th>
            <td><?php echo $_REQUEST['env_name']; ?></td>
          </tr>
          <tr>
            <th> <label for="spider_name"> Spider Name </label>
            </th>
            <td><?php echo $_REQUEST['spider_name']; ?></td>
          </tr>
          <tr>
            <th> <label for="log_name"> Log File Name </label>
            </th>
            <td><?php echo $_REQUEST['log_name']; ?></td>
          </tr>
          <tr>
            <th> <label for="proj_loc"> Project Location </label>
            </th>
            <td><?php echo $_REQUEST['proj_loc']; ?></td>
          </tr>
        </table>

      </div>

      <div class="green bottom">
        <?php
        $output = shell_exec('wmic cpu get loadpercentage');
        echo $output; echo "<br />";

        $ram_free = shell_exec('systeminfo |find "Available Physical Memory"');
        echo $ram_free; echo "<br />";
        ?>
        <script type="text/javascript">window.onload = date_time('date_time');</script>
       
        </div>
      <div>
        <p class="message warning bottom">The <strong> output console </strong>is directly shown in right side.
        <strong>Be patient! </strong> if nothing are shown in a small amount of time.
      </p>
      </div>

      <a class="button" href="link.php">See details</a>

    </div>
    <!--===============================================================  Contact form =====================================================================================-->
    <div class="grid-10 grid">
      <h2>Crawling Console</h2>


      <?php

      ini_set('max_execution_time', 0); 
      

      $env_n = $_REQUEST['env_name'];
      $spider_n = $_REQUEST['spider_name'];
      $log_n = $_REQUEST['log_name'];
      $proj_l = $_REQUEST['proj_loc'];

      chdir($proj_l);
      #chdir('C:\Users\thawd\thesis\agent');

      echo '<pre>';
      $cmd = "activate ".$env_n. " && scrapy crawl ".$spider_n." -s LOG_FILE=".$log_n."";
      #passthru($cmd);
      echo '</pre>';

      while (@ ob_end_flush()); // end all output buffers if any

      $proc = popen($cmd, 'r');
      echo '<pre>';
      while (!feof($proc))
      {
          echo fread($proc, 4096);
          @ flush();
      }
      echo '</pre>';

      ?>





    </div>
    <!--end of grid-10-->
  </div>
  <!--end of grids-->
</div>
<!--end of wrapper-->
<!--===============================================================  Footer =====================================================================================-->
<div class="wrapper">
  <div id="footer">
    <div class="grids">
      <div class="grid-5 grid text-center">
        <p>&copy;  <a target="_blank" href="">Thaw De Zin</a></p>
      </div>
      <div class="grid-6 grid text-center">
        <p>6IST-66</p>
      </div>
      <div class="grid-5 grid text-center">
        <p>Contact me <a href="https://www.facebook.com/thawdezin">here</a></p>
      </div>
    </div>
    <!--end of grids-->
  </div>
  <!--end of footer-->
</div>
<!--end of wrapper-->
</body>
</html>
