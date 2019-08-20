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
        
        <p> You can check and see in detail of how the entire thesis works by clicking each of these links.
        </p>
      </div>
      <div>
       
      </div>
    </div>
    <!--===============================================================  Contact form =====================================================================================-->
    <div class="grid-10 grid">
      <h2>Click each links to see details</h2>  

            <?php
                require_once "config.php";
                $query = "SELECT link FROM step";
                $result = mysqli_query($link,$query);
                
                
                while($row=mysqli_fetch_array($result)){                                                 
                  echo "<table class='form'><tr><td>";
                  echo "<a href=step.php?link=".$row["link"].">";
                  echo $row["link"];
                  echo "</a>";
                  echo "</td></tr></table>";
                }
                
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
