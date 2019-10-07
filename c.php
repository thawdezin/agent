
<html>
<body>

<?php
if(isset($_POST['submit'])){
$proce = $_REQUEST["processor"];
echo ($proce);
$ram = $_REQUEST["ram"];
echo ($ram);
$hdd = $_REQUEST["hdd"];
echo ($hdd);
$brand = $_REQUEST["brand"];
echo ($brand);
$price = $_REQUEST["price"];
echo ($price);

echo("<br />");

$query = 'SELECT link FROM laptop WHERE processor="'.$proce.'" AND '.' ram ="'.$ram.'" AND '.'hdd="'.$hdd.'" AND '.'brand="'.$brand.'"';
echo ($query);
}
?>

<h5>Product 3</h5>
      Available url : <a href=""> Here </a>
      <br />
      Brand : HP
      <br />
      Price : 1047280
      <br />
      Processor : 8th Generation Intel Core i5
      <br />

</body>
</html>