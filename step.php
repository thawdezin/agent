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
    <!--===============================================================  Contact form =====================================================================================-->

    <h2><center> Step by Step Explanation </center></h2>
            <h3><center>response.body </center></h3>
            <hr>
            <div class="green bottom">
              <p> The System read the response.body from each links obtained by Web Crawler. The looks like the Ctrl+U or View Source of any webpage.
              </p>
            </div>
            <?php
                require_once "config.php";
                $input_from_link = $_GET["link"];
                $query = "SELECT body FROM step where link=";
                $query = $query.'"';
                $query = $query.$input_from_link.'"';
                $result = mysqli_query($link,$query);
                //echo $query;
                
                while($row=mysqli_fetch_array($result)){                                                 
                  echo "<table class='form'><tr><td>";
                  echo "<pre>"; 
                  echo substr(htmlspecialchars($row['body']), 0, 3000);
                  echo "</pre>";
                  echo "</td></tr></table>";
                }      
            ?>

            <h3><center>response.body without html tags </center></h3>
            <hr>
            <div class="green bottom">
              <p> The System read the response.body from each links obtained by Web Crawler. The looks like the Ctrl+U or View Source of any webpage.
              </p>
            </div>
            <?php
              require_once "config.php";
              $input_from_link = $_GET["link"];
              $query = "SELECT body_w FROM step where link=";
              $query = $query.'"';
              $query = $query.$input_from_link.'"';
              $result = mysqli_query($link,$query);
              //echo $query;
                        
              while($row=mysqli_fetch_array($result)){                                                 
                echo "<table class='form'><tr><td>";
                #echo "<pre>";
                $body_without_tags = htmlspecialchars($row['body_w']);
                $body_without_tags = preg_replace('/\s+/', ' ', $body_without_tags);
                echo substr($body_without_tags, 0, 3000);
                #echo "</pre>";
                echo "</td></tr></table>";
              }
            ?>

            <!-- <h3><center> Important Tags to Scrape </center></h3>
              <h6><center> response.css("[tag_name]").extract() </center></h6>
                <hr>
                <div class="green bottom">
                  <p> Here are the important list of tags that are useful for information scraping.
                  </p>
                </div> -->
                <!-- <?php
                  require_once "config.php";
                  $input_from_link = $_GET["link"];
                  $query = "SELECT tags FROM step where link=";
                  $query = $query.'"';
                  $query = $query.$input_from_link.'"';
                  $result = mysqli_query($link,$query);
                  //echo $query;
                            
                  while($row=mysqli_fetch_array($result)){                                                 
                    echo "<table class='form'><tr><td>";
                    #echo "<pre>";
                    $item_without_tags = htmlspecialchars($row['tags']);
                    $item_without_tags = preg_replace('/\s+/', ' ', $item_without_tags);
                    echo $item_without_tags;
                    echo "Test";
                    echo $row['tags'];
                    #echo "</pre>";
                    echo "</td></tr></table>";
                  }
                ?> -->

        <h3><center> Important Data without Tags </center></h3>
          <h6><center> response.css("[tag_name]::text").extract() </center></h6>
            <hr>
            <div class="green bottom">
              <p> The System scrape the useful tags to get the required information about the product. But withtin these tags, there are some rabbish items to be removed that is extran whitespaces, \n , \t and information that are not for product specifications. 
              </p>
            </div>
            <?php
              require_once "config.php";
              $input_from_link = $_GET["link"];
              $query = "SELECT tags FROM step where link=";
              $query = $query.'"';
              $query = $query.$input_from_link.'"';
              $result = mysqli_query($link,$query);
              //echo $query;
                        
              while($row=mysqli_fetch_array($result)){                                                 
                echo "<table class='form'><tr><td>";
                #echo "<pre>";
                $item_without_tags = htmlspecialchars($row['tags']);
                $item_without_tags = preg_replace('/\s+/', ' ', $item_without_tags);
                echo $item_without_tags;
                echo $row['tags'];
                #echo "</pre>";
                echo "</td></tr></table>";
              }
            ?>

<h3><center> Simplified Form of Data </center></h3>
    <hr>
    <div class="green bottom">
      <p> Here you can check the scraped information about the products. 
          After removing unnecessary data about product, the data is ready to store in Database (MySQL) and can access it via PHP pages.

      </p>
    </div>
    <?php
      require_once "config.php";
      $input_from_link = $_GET["link"];
      $query = "SELECT brand FROM step where link=";
      $query = $query.'"';
      $query = $query.$input_from_link.'"';
      $result = mysqli_query($link,$query);
                
      while($row=mysqli_fetch_array($result)){                                                 
        echo substr(htmlspecialchars($row['brand']), 0, 2000);
      }
      echo "<br />";

      $query = "SELECT display FROM step where link=";
      $query = $query.'"';
      $query = $query.$input_from_link.'"';
      $result = mysqli_query($link,$query);
                
      while($row=mysqli_fetch_array($result)){                                                 
        echo substr(htmlspecialchars($row['display']), 0, 2000);
      }
      echo "<br />";
      $query = "SELECT graphic FROM step where link=";
      $query = $query.'"';
      $query = $query.$input_from_link.'"';
      $result = mysqli_query($link,$query);
                
      while($row=mysqli_fetch_array($result)){                                                 
        echo substr(htmlspecialchars($row['graphic']), 0, 2000);
      }
      echo "<br />";

      $query = "SELECT hdd FROM step where link=";
      $query = $query.'"';
      $query = $query.$input_from_link.'"';
      $result = mysqli_query($link,$query);
                
      while($row=mysqli_fetch_array($result)){                                                 
        echo substr(htmlspecialchars($row['hdd']), 0, 2000);
      }
      echo "<br />";
      $query = "SELECT processor FROM step where link=";
      $query = $query.'"';
      $query = $query.$input_from_link.'"';
      $result = mysqli_query($link,$query);
                
      while($row=mysqli_fetch_array($result)){                                                 
        echo substr(htmlspecialchars($row['processor']), 0, 2000);
      }
      echo "<br />";
      $query = "SELECT price FROM step where link=";
      $query = $query.'"';
      $query = $query.$input_from_link.'"';
      $result = mysqli_query($link,$query);
                
      while($row=mysqli_fetch_array($result)){                                                 
        echo substr(htmlspecialchars($row['price']), 0, 2000);
      }
      echo "<br />";
      $query = "SELECT ram FROM step where link=";
      $query = $query.'"';
      $query = $query.$input_from_link.'"';
      $result = mysqli_query($link,$query);
                
      while($row=mysqli_fetch_array($result)){                                                 
        echo substr(htmlspecialchars($row['ram']), 0, 2000);
      }
      echo "<br />";

    ?>


    <!--end of Complete Step-->
  </div>
  <!--end of grids-->
</div>
<!--end of wrapper-->
<!--===============================================================  Footer =====================================================================================-->
<div class="wrapper">
  <div id="footer">
    <div class="grids">
      <div class="grid-5 grid text-center">
        <p>&copy; <a target="_blank" href="">Thaw De Zin</a></p>
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
