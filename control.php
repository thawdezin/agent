<!DOCTYPE html>
<html lang="en">
<head>
<title>Mini Agent | Control</title>
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
  <h1 class="accessibility">ResponseEve, a responsive template by SiGa</h1>
  </a>
  <div class="social"> <a href="#"><img src="img/facebook.png" width="20" height="20" alt=""></a> <a href="#"><img src="img/twitter.png" width="20" height="20" alt=""></a> <a href="#"><img src="img/linkedin.png" width="20" height="20" alt=""></a> <a href="#"><img src="img/vcard.png" width="20" height="20" alt=""></a> <a href="#"><img src="img/picasa.png" width="20" height="20" alt=""></a> </div>
  <ul id="nav" class="main">
    <li><a href="index.html">Home </a></li>
    <li><a href="subpage.html">Subpage</a></li>
    <li><a href="#">Dummy 1</a></li>
    <li><a href="#">Dummy 2</a></li>
    <li><a href="#">Dummy 3</a></li>
    <li><a href="contact.html" class="active">Contact</a></li>
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
    </div>
    <!--===============================================================  Contact form =====================================================================================-->
    <div class="grid-10 grid">
      <h2>Control Centre</h2>
      <?php
      $dbc = mysqli_connect('localhost', 'root', 'dede', 'agent') or die('Error connecting to MySQL server.'); 
      if(isset($_POST['submit_button']))
      {
          mysqli_query($dbc, 'TRUNCATE TABLE lin');
          header("Location: " . $_SERVER['PHP_SELF']);
          exit();
      }

      ?>
      <form method="post" action="">
          <input name="submit_button" type="submit" value=" Truncate Table " />
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
