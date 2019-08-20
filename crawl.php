<!DOCTYPE html>
<html lang="en">
<head>
<title>Mini Agent | Crawl</title>
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
<!--[if lte IE 7]>
<style>
hr { display:block; height:1px; border:0; border-top:1px solid #fff; margin:1em 0; padding:0; }
.grid-4{ width:22% }
</style>
<![endif]-->
</head>
<!--===============================================================  Logo, social and menu =====================================================================================-->
<body>
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
        
        <p> Please fill every detail about your project for start crawling. 
        </p>
      </div>
      <div>
        <p class="message warning bottom">The input from this page is too important and dangerous. <strong> Beware! </strong></p>
      </div>
      <a class="button" href="link.php">See details</a>
    </div>
    <!--===============================================================  Contact form =====================================================================================-->
    <div class="grid-10 grid">
      <h2>Crawling Input</h2>
      <form action="crawling_result.php" method="post">
        <table class="form">
          <tr>
            <th> <label for="env_name"> Anaconda Environment Name </label>
            </th>
            <td><input class="input_full" type="text" id="env_name" name="env_name" required="required" value="tdz"></td>
          </tr>
          <tr>
            <th> <label for="spider_name"> Spider Name </label>
            </th>
            <td><input class="input_full" type="text" id="spider_name" name="spider_name" required="required" placeholder="lin"></td>
          </tr>
          <tr>
            <th> <label for="log_name"> Log File Name </label>
            </th>
            <td><input class="input_full" type="text" id="log_name" name="log_name" placeholder="name.log" required="required"></td>
          </tr>
          <tr>
            <th> <label for="proj_loc"> Project Location </label>
            </th>
            <td><input class="input_full" type="text" id="proj_loc" name="proj_loc" placeholder="C:\Users\thawd\thesis\agent" value="C:\Users\thawd\thesis\agent"></td>
          </tr>
        </table>
      <?php
      session_start();
      $_SESSION['ok'] = "crawling";
      ?>
      <input type="submit" value="OK">
      </form>
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
