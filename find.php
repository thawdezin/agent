<!DOCTYPE html>
<html lang="en">
<head>
<title>Mini Agent | Find Product</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="css/inuit.css">
<link rel="stylesheet" href="css/fluid-grid16-1100px.css">
<link rel="stylesheet" href="css/eve-styles.css">
<link rel="shortcut icon" href="icon.png">
<link rel="apple-touch-icon-precomposed" href="img/icon.png">
<script src="js/respond-min.js"></script>
<script src="js/jquery164min.js"></script>
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
  <h1> Mini Web Agent for Choosing the Right Product</h1>
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
<!--===============================================================  Intro =====================================================================================-->
<div class="wrapper">
  <div class="grids">
    <div class="grid-16 grid intro grey">
      <!-- <p>Where there an internet, there is a dataset</p> -->
    </div>
    <!--end of slogan div-->
  </div>
  <!--end of div grids-->
</div>
<!--end of div wrapper-->
<!--===============================================================  Green box (sidebar) =====================================================================================-->
<div class="wrapper">
  <div class="grids">
    <div class="grid-6 grid green">
      <h2>Input Your requirements</h2>
      <p> You can choose 2 of 3 in input files which is Brand, Specations and Price</p>
      <h5>Technology, method and Algorithms </h5>
      <p>The system will use Web Crawling, Web Scraping, TF-IDF, text processing and K-Nearest Neighbors Algorithm to determine relevent results.</p>
      <h5>Result</h5>
      <p> You will see 3 laptops that match to your input query.</p>
      <a class="button" href="link.php">See details</a>
    </div>
    <!--===============================================================  Style playground =====================================================================================-->
    <div class="grid-10 grid">
      <h3>Product details </h3>
      
      <h6>Choose your maximum target specifications </h6>
      Processor : 

      <select>
      <?php
          require_once "config.php";
          $query = "SELECT DISTINCT processor FROM laptop";
          $result = mysqli_query($link,$query);
          
          while($row=mysqli_fetch_array($result)){                                                 
            echo "<option value='".$row['processor']."'>".$row['processor']."</option>";
          }
          
      ?>
      </select>

      <br />
      <br />
      RAM : 

      <select>
      <?php
          require_once "config.php";
          $query = "SELECT DISTINCT ram FROM laptop";
          $result = mysqli_query($link,$query);
          
          while($row=mysqli_fetch_array($result)){                                                 
            echo "<option value='".$row['ram']."'>".$row['ram']."</option>";
          }
          
      ?>
      </select>

      <br />
      <br />
      Storage Size : 
      <select>
      <?php
          require_once "config.php";
          $query = "SELECT DISTINCT hdd FROM laptop";
          $result = mysqli_query($link,$query);
          
          while($row=mysqli_fetch_array($result)){                                                 
            echo "<option value='".$row['hdd']."'>".$row['hdd']."</option>";
          }
          
      ?>
      </select>
      
      <br />
      <br />
      <h6>Choose Your target brand : </h6>

      <select>
      <?php
          require_once "config.php";
          $query = "SELECT DISTINCT brand FROM laptop";
          $result = mysqli_query($link,$query);
          
          while($row=mysqli_fetch_array($result)){                                                 
            echo "<option value='".$row['brand']."'>".$row['brand']."</option>";
          }
          
      ?>
      </select>

      <br />
      <br />
      <h6>Choose Your target price amount : </h6> 
      <select>
        <option value="price1">below 5 lakhs</option>
        <option value="price2">between 5 and 7 lakhs</option>
        <option value="price3">between 7 and 10 lakhs</option>
        <option value="price4">between 10 and 13 lakhs </option>
        <option value="price5">between 13 and 15 lakhs</option>
        <option value="price6">over 15 lakhs</option>
      </select>
      <br />
      <br />
      <p><a class="button" href="">Submit & Find</a></p>
    </div>
    <!--end of grid-10-->
  </div>
  <!--end of grids-->
  <hr>
</div>
<!--end of wrapper-->
<!--===============================================================  Bottom content =====================================================================================-->
<div class="wrapper">
  <div class="grids">
    <div class="grid-4 grid"> <img src="img/crawl.jpg" alt="Web Crawling">
      <h4 class="text-center">Web Crawling</h4>
      <p>A Web crawler, sometimes called a spider or spiderbot and often shortened to crawler, is an Internet bot that systematically browses the World Wide Web, typically for the purpose of Web indexing (web spidering).

        Web search engines and some other sites use Web crawling or spidering software to update their web content or indices of others sites' web content. Web crawlers copy pages for processing by a search engine which indexes the downloaded pages so users can search more efficiently.
        
        Crawlers consume resources on visited systems and often visit sites without approval.</p>
    </div>
    <div class="grid-4 grid"> <img src="img/scrape.jpg" alt="Web Scraping">
      <h4 class="text-center">Web Scraping</h4>
      <p>Web scraping, web harvesting, or web data extraction is data scraping used for extracting data from websites. Web scraping software may access the World Wide Web directly using the Hypertext Transfer Protocol, or through a web browser. While web scraping can be done manually by a software user, the term typically refers to automated processes implemented using a bot or web crawler. It is a form of copying, in which specific data is gathered and copied from the web, typically into a central local database or spreadsheet, for later retrieval or analysis.</p>
    </div>
    <div class="grid-4 grid"> <img src="img/tfidf.jpg" alt="">
      <h4 class="text-center">TFIDF</h4>
      <p>In information retrieval, tf–idf or TFIDF, short for term frequency–inverse document frequency, is a numerical statistic that is intended to reflect how important a word is to a document in a collection or corpus. It is often used as a weighting factor in searches of information retrieval, text mining, and user modeling. The tf–idf value increases proportionally to the number of times a word appears in the document and is offset by the number of documents in the corpus that contain the word, which helps to adjust for the fact that some words appear more frequently in general. tf–idf is one of the most popular term-weighting schemes today; 83% of text-based recommender systems in digital libraries use tf–idf.</p>
    </div>
    <div class="grid-4 grid"> <img src="img/knn.jpg" alt="">
      <h4 class="text-center">K-Nearest Neighbors</h4>
      <p>k-NN is a type of instance-based learning, or lazy learning, where the function is only approximated locally and all computation is deferred until classification.

        Both for classification and regression, a useful technique can be to assign weights to the contributions of the neighbors, so that the nearer neighbors contribute more to the average than the more distant ones. For example, a common weighting scheme consists in giving each neighbor a weight of 1/d, where d is the distance to the neighbor.
        
        The neighbors are taken from a set of objects for which the class (for k-NN classification) or the object property value (for k-NN regression) is known. This can be thought of as the training set for the algorithm, though no explicit training step is required.</p>
    </div>
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
<!--Javascript for Tabs by Sohtanaka, include it on pages where you use tabs, else delete it-->
<script>
$(document).ready(function () {
    //When page loads...
    $(".tab_content").hide(); //Hide all content
    $("ul.tabs li:first").addClass("active").show(); //Activate first tab
    $(".tab_content:first").show(); //Show first tab content
    //On Click Event
    $("ul.tabs li").click(function () {
        $("ul.tabs li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
        $(".tab_content").hide(); //Hide all tab content
        var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
        $(activeTab).fadeIn(); //Fade in the active ID content
        return false;
    });
});
</script>
</body>
</html>
