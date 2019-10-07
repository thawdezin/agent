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

  <ul id="nav" class="main">
    <li><a href="index.php">Home</a></li>
    <li><a href="crawl.php" class="active">Crawl</a></li>
    <li><a href="search.php">Find items</a></li>
    <li><a href="https://scrapy.org/">Framework</a></li>
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
      <p> Here are the best matching with your input query.</p>
      <h5>Technology, method and Algorithms </h5>
      <p>The system will use Web Crawling, Web Scraping, TF-IDF, text processing and Levenshtein Edit Distance Algorithm to determine relevent results.</p>
      <h5>Result</h5>
      <p> You will see the laptops that match to your input query.</p>
      
    </div>
    <!--===============================================================  Style playground =====================================================================================-->
    <div class="grid-10 grid">
         

        <?php
        error_reporting(0);
        if(isset($_POST['search']))
        {

            $brand = $_POST['brand']; // make value
            $price = $_POST['price'];
            $hdd = $_POST['hdd'];
            $ram = $_POST['ram'];
            $processor = $_POST['processor'];
            $quantity = $_POST['quantity'];


            if ($price == null){
              $price = "N/A";
            }
            if ($brand == null){
              $brand = "N/A";
            }
            if ($hdd == null){
              $hdd = "N/A";
            }
            if ($ram == null){
              $ram = "N/A";
            }
            if ($processor == null){
              $processor = "N/A";
            }

            echo "<h6> You're searching the laptop that match your requirement of below </h6>";
            echo "<br />";
            echo "Brand = ".$brand;
            echo "<br />";
            echo "Price = ".$price;
            echo "<br />";
            echo "HDD = ".$hdd;
            echo "<br />";
            echo "RAM = ".$ram;
            echo "<br />";
            echo "Processor = ".$processor;
            echo "<br />";
            echo "Quantity = ".$quantity;
            echo "<br />";
            echo "<br />";
            echo "<hr />";
            //************************************************************************************************* */
            // အရေးကြီးသည့် Input များအားလုံး ဒီနေရာမှာ ရနေပါပြီ
            //************************************************************************************************* */

            if ($price != "N/A"){
              if ($price == 'below 5 lakhs'){
                require_once "config.php";
                $copy_from_all_laptop = "INSERT INTO processing SELECT * FROM all_laptop WHERE all_laptop.price < 500000";
                mysqli_query($link,$copy_from_all_laptop);
                //echo "below 5 lakhs";
              }
              if ($price == 'between 5 and 7 lakhs'){
                require_once "config.php";
                $copy_from_all_laptop = "INSERT INTO processing SELECT * FROM all_laptop WHERE all_laptop.price > 499999 AND all_laptop.price < 700000";
                mysqli_query($link,$copy_from_all_laptop);
                //echo "between 5 and 7 lakhs";
              }
              if ($price == 'between 7 and 10 lakhs'){
                require_once "config.php";
                $copy_from_all_laptop = "INSERT INTO processing SELECT * FROM all_laptop WHERE all_laptop.price > 699999 AND all_laptop.price < 1000000";
                mysqli_query($link,$copy_from_all_laptop);
                //echo "between 7 and 10 lakhs";
              }
              if ($price == 'between 10 and 13 lakhs'){
                require_once "config.php";
                $copy_from_all_laptop = "INSERT INTO processing SELECT * FROM all_laptop WHERE all_laptop.price > 999999 AND all_laptop.price < 1300000";
                mysqli_query($link,$copy_from_all_laptop);
                //echo "between 10 and 13 lakhs";
              }
              if ($price == 'between 13 and 15 lakhs'){
                require_once "config.php";
                $copy_from_all_laptop = "INSERT INTO processing SELECT * FROM all_laptop WHERE all_laptop.price > 1299999 AND all_laptop.price < 1500000";
                mysqli_query($link,$copy_from_all_laptop);
                //echo "between 13 and 15 lakhs";
              }
              if ($price == 'over 15 lakhs'){
                require_once "config.php";
                $copy_from_all_laptop = "INSERT INTO processing SELECT * FROM all_laptop WHERE all_laptop.price > 1499999";
                mysqli_query($link,$copy_from_all_laptop);
                //echo "over 15 lakhs";
              }
            
            // require_once "config.php";
            // $insert_into_temp = "INSERT INTO temp SELECT * FROM processing WHERE processing.brand = '$brand'";
            // mysqli_query($link,$insert_into_temp);

            $input_requirement = null;

            if($brand != 'N/A'){ //Brand ကိုရွေးသည်

              require_once "config.php";
              $insert_into_temp = "INSERT INTO temp SELECT * FROM processing WHERE processing.brand = '$brand'";
              //echo "INSERT INTO temp SELECT * FROM processing WHERE processing.brand = '$brand'";
              mysqli_query($link,$insert_into_temp);
  
              $input_requirement = null;


              $input_requirement = $brand ." ". $price;
              //echo " TESTING == ".$input_requirement;
              //echo "<br />";
            
              for ($x = 1; $x <= $quantity; $x++) {
                //echo "LOOP ".$x;
                require_once "config.php";
                $query = "SELECT MIN(price) AS min_price , id FROM temp";
                $result = mysqli_query($link,$query);
                
                while($row=mysqli_fetch_array($result)){                                                 
                  $from_table = $row['min_price'];
                  $del_id = $row['id'];
                  //echo "FROM DATABASE :: ".$from_table;
                  //echo "<br /> and del id is ".$del_id;

                  require_once "config.php";
                  $query = "INSERT INTO result (brand, display, graphic, hdd, id, link, name, price, processor, ram) SELECT brand, display, graphic, hdd, id, link, name, price, processor, ram FROM temp WHERE id = '$del_id'";
                  mysqli_query($link,$query);

                  require_once "config.php";
                  $del_query = "DELETE FROM temp WHERE id = '$del_id'";
                  mysqli_query($link,$del_query);
                  
                }
              }
            //************************************************************************************************* */
            // P B
            //************************************************************************************************* */
            }
            
            if($brand == 'N/A'){ //Brand ကိုမရွေးပါ

              require_once "config.php";
              $insert_into_temp = "INSERT INTO temp SELECT * FROM processing";
              mysqli_query($link,$insert_into_temp);
  
              $input_requirement = null;

              $input_requirement = $processor ." ". $ram ." ". $hdd;
              //echo " TESTING == ".$input_requirement;
              //echo "<br />";
            
              $shortest = -1;
              for ($x = 1; $x <= $quantity; $x++) {
                //echo "LOOP ".$x ." <br />";
                require_once "config.php";
                $query = "SELECT processor, ram, hdd, id FROM temp";
                $result = mysqli_query($link,$query);
                
                while($row=mysqli_fetch_array($result)){
                  
                  $from_table = $row['processor'];
                  $del_id = $row['id'];
                  //echo "FROM DATABASE :: ".$from_table;
                  //echo "<br /> and del id is ".$del_id;

                  require_once "config.php";
                  $query = "INSERT INTO result (brand, display, graphic, hdd, id, link, name, price, processor, ram) SELECT brand, display, graphic, hdd, id, link, name, price, processor, ram FROM temp WHERE id = '$del_id'";
                  mysqli_query($link,$query);

                  require_once "config.php";
                  $del_query = "DELETE FROM temp WHERE id = '$del_id'";
                  mysqli_query($link,$del_query);


                  }
                }

            //************************************************************************************************* */
            // P S
            //************************************************************************************************* */
            }
            } // ဈေးနှုန်းပါဝင်သည့် ကုဒ်များ ဒီလိုင်းအထက်မှာ ရေးရန်
            else{ // ဈေးနှုန်း မပါသည့် ကုဒ်များ အောက်ကလိုင်း 
              $input_requirement = $brand." ".$processor." ".$ram." ".$hdd;

              require_once "config.php";
              $insert_into_temp = "INSERT INTO temp SELECT * FROM all_laptop WHERE all_laptop.brand = '$brand'";
              mysqli_query($link,$insert_into_temp);
  
              //echo " TESTING == ".$input_requirement;
              //echo "<br />";

              $shortest = -1;
              for ($x = 1; $x <= $quantity; $x++) {

                //echo "LOOP ".$x;
                require_once "config.php";
                $query = "SELECT processor, ram, hdd, id FROM temp";
                $result = mysqli_query($link,$query);

                while($row=mysqli_fetch_array($result)){                                                 
                  $from_table = $brand." ".$row['processor']." ".$row['ram']." ".$row['hdd'];
                  $del_id = $row['id'];
                  //echo "FROM DATABASE :: ".$from_table;
                  //echo "<br /> and del id is ".$del_id;

                  // calculate the distance between the input word,
                  // and the current word
                  $lev = levenshtein($input_requirement, $from_table);
                  // check for an exact match
                  if ($lev == 0) {
                      // closest word is this one (exact match)
                      $closest = $from_table;
                      $shortest = 0;
                      require_once "config.php";
                      $query = "INSERT INTO result (brand, display, graphic, hdd, id, link, name, price, processor, ram) SELECT brand, display, graphic, hdd, id, link, name, price, processor, ram FROM temp WHERE id = '$del_id'";
                      //echo "INSERT INTO result (brand, display, graphic, hdd, id, link, name, price, processor, ram) SELECT brand, display, graphic, hdd, id, link, name, price, processor, ram FROM temp WHERE id = '$del_id'";
                      mysqli_query($link,$query);
    
                      require_once "config.php";
                      $del_query = "DELETE FROM temp WHERE id = '$del_id'";
                      //echo "<br />";
                      //echo "DELETE FROM temp WHERE id = '$del_id'";
                      mysqli_query($link,$del_query);   
                      // break out of the loop; we've found an exact match
                      break;
                  }
                  // if this distance is less than the next found shortest
                  // distance, OR if a next shortest word has not yet been found
                  if ($lev <= $shortest || $shortest < 0) {
                      // set the closest match, and shortest distance
                      $closest  = $from_table; # input string က ဟာကို တစ်ခုချင်းလျော့ပြီး ဒီကနေ ညီတဲ့ တူတဲ့တစ်ခုကို ဖြုတ်ပေးနိုင်ရင် ရပြီ
                      $shortest = $lev;
                  }
                  
                  require_once "config.php";
                  $query = "INSERT INTO result (brand, display, graphic, hdd, id, link, name, price, processor, ram) SELECT brand, display, graphic, hdd, id, link, name, price, processor, ram FROM temp WHERE id = '$del_id'";
                  //echo "INSERT INTO result (brand, display, graphic, hdd, id, link, name, price, processor, ram) SELECT brand, display, graphic, hdd, id, link, name, price, processor, ram FROM temp WHERE id = '$del_id'";
                  mysqli_query($link,$query);

                  require_once "config.php";
                  $del_query = "DELETE FROM temp WHERE id = '$del_id'";
                  //echo "<br />";
                  //echo "DELETE FROM temp WHERE id = '$del_id'";
                  mysqli_query($link,$del_query);   
                }

              }

            //echo "brand and spec";
            //************************************************************************************************* */
            // B S
            //************************************************************************************************* */
            } // Brand && Spec ဆို ဒီလိုင်းအထက်မှာရေး


            //************************************************************************************************* */
            // ဤနေရာသို့ ရောက်ရှိချိန်တွင် သင့်၏ ဘွဲ့ယူကျမ်းဟုခေါ်သော Thesisကြီး အောင်မြင်စွာ ပြီးဆုံးပါပြီ သော်ဒီဇင်လေးရေ 😆😆😆
            //************************************************************************************************* */

        }//ဒီတွန့်ကွင်းလေးထဲမှာပဲ ကုဒ်အားလုံးရေးဖို့ လိုပါသည်။

        require_once "config.php";
        $result_query = "SELECT * FROM result LIMIT ".$quantity;
        $final_result = mysqli_query($link,$result_query);
        
        echo "<table> <tr> <th> Best Suitable laptops for you </th> </tr>";
        while($row=mysqli_fetch_array($final_result)){                                                 
          echo "<tr> <td> <a href=' ".$row['link']." '> ". $row['link'] . " </a> </td> </tr> ";
        }
        echo "</table>";

        // <!-- // ဒါပေမဲ့လည်း တစ်ခါတစ်လေ တွန့်ကွင်း အပြင်ထွက် ရေးရတာမျိုးလည်း ရှိနိုင်တာပေါ့ 🤣🤣🤣 -->
        ?> 
        

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
