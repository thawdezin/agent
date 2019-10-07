<?php

require_once "config.php";
$query = "SELECT * FROM learn";
$result = mysqli_query($link,$query);


$dataset = [];

while($row=mysqli_fetch_array($result)){
    $ans = $row['name']." ".$row['number']." ".$row['address'];
    //echo "$ans is the row of MySQL";
    array_push($dataset,$ans);
}


// print_r($dataset);
// ဤနေရာတွင် အမှန်တစ်ကယ် အသုံးပြု၍ ရသော Array ထွက်လာသည်

echo "<h1> Final Result </h1>";
echo "<br />";

$input = "Jesus Christ 333 Mecca 3";
// no shortest distance found, yet
$shortest = -1;
$closest = null;
$percent_test = 0;

$count = 3;
for ($x = 0; $x <= $count; $x++) {

echo "အပြင်loop".$x."<br />";

foreach ($dataset as $data) {

    echo $data. " <br /> ";

    // calculate the distance between the input word,
    // and the current word
    $lev = levenshtein($input, $data);
    // print($lev." is ".$data);
    // print("<br />");
    // check for an exact match
    if ($lev == 0) {

        // closest word is this one (exact match)
        $closest = $data;
        $shortest = 0;

        // break out of the loop; we've found an exact match
        break;
    }

    // if this distance is less than the next found shortest
    // distance, OR if a next shortest word has not yet been found
    if ($lev <= $shortest || $shortest < 0) {
        // set the closest match, and shortest distance
        $closest  = $data; # input string က ဟာကို တစ်ခုချင်းလျော့ပြီး ဒီကနေ ညီတဲ့ တူတဲ့တစ်ခုကို ဖြုတ်ပေးနိုင်ရင် ရပြီ
        $shortest = $lev;
        if (($key = array_search($data, $dataset)) !== false) {
            unset($dataset[$key]);
        }
        $dataset = array_values($dataset);
    }

    similar_text($data,$input,$percent);
    print($percent . " and ". $percent_test." is Percent Test <br />");
    // if($percent > $percent_test){
    //     $percent_test = $percent;
    //     print($closest." <<<<<<<<<<<<<<<<<<<<<<<<<<< <br />");
    // }
}

// if ($shortest == 0) {
//     echo "Exact match found: $closest\n";

// } else {
//     echo "Did you mean: $closest?\n";
//     echo "<br />";
// }


// if (($key = array_search($data, $dataset)) !== false) {
//     unset($dataset[$key]);
// }
// unset($data);
// $dataset = array_values($dataset);

}//User လိုချင်သော အရေအတွက်အတိုင်း loop ပတ်ခြင်း ဤနေရာတွင် ပြီးသည်

?>

