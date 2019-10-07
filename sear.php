<!-- <form action="#" method="post">
<input type="checkbox" name="gender" value="Male">Male</input>
<input type="checkbox" name="gender" value="Female">Female</input>
<input type="submit" name="submit" value="Submit"/>
</form>
<?php
if (isset($_POST['gender'])){
echo $_POST['gender']; // Displays value of checked checkbox.
}
?> -->

<form action="#" method="post">
<input type="checkbox" name="check_list[]" value="Price"><label>Price</label><br/>
<input type="checkbox" name="check_list[]" value="Brand"><label>Brand</label><br/>
<input type="checkbox" name="check_list[]" value="Spec"><label>Spec</label><br/>
<input type="submit" name="submit" value="Choose 2 types"/>
</form>

<form method="POST" >
<?php
if(isset($_POST['submit'])){//to run PHP script on submit
if(!empty($_POST['check_list'])){
// Loop to store and display values of individual checked checkbox.
foreach($_POST['check_list'] as $selected){
echo $selected."</br>";
if($selected == "Spec"){

    echo "<select name='brand'>";

        require_once "config.php";
        $query = "SELECT DISTINCT brand FROM laptop";
        $result = mysqli_query($link,$query);
        
        while($row=mysqli_fetch_array($result)){                                                 
          echo "<option value='".$row['brand']."'>".$row['brand']."</option>";
        }
        

    echo "</select>";
    echo "";
}
if($selected == "Brand"){
    echo "BBB";
}
}
}
}
?>
<input type="submit" name="search" value="OK OK K"/>
</form>

<!-- <form method="POST" >
<label for="Manufacturer"> Manufacturer : </label>
  <select id="cmbMake" name="Make" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
     <option value="0">Select Manufacturer</option>
     <option value="1">--Any--</option>
     <option value="2">Toyota</option>
     <option value="3">Nissan</option>
</select>
<input type="hidden" name="selected_text" id="selected_text" value="" />
<input type="submit" name="search" value="Search"/>
</form> -->


<?php

if(isset($_POST['search']))
{

    $makerValue = $_POST['brand']; // make value


    echo $makerValue;
}
?>