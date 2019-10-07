    <?php
      $dbc = mysqli_connect('localhost', 'root', 'dede', 'agent') or die('Error connecting to MySQL server.'); 
      if(isset($_POST['submit_button']))
      {
          mysqli_query($dbc, 'TRUNCATE TABLE table1');
          mysqli_query($dbc, 'TRUNCATE TABLE table2');
          header("Location: " . $_SERVER['PHP_SELF']);
          exit();
      }
      ?>
      <form method="post" action="">
          <input name="submit_button" type="submit" value=" Truncate Laptop Table and Step table" />
      </form>