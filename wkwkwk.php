<?php
$value = levenshtein("Thaw" ,"thaw ahae");
echo $value;
echo "<br />";
?>

<?php
// input misspelled word
$input = 'God';
$input = strtolower($input);
$words  = array('Muhammad',
                'Jesus Christ',
                'Jehovah',
                'Noah',
                'Moses',
                'Abraham',
                'Adam');
$words = array_map('strtolower', $words);
print_r($words);
// array of words to check against

echo "<h1> Before </h1>";
echo "<br />";
// no shortest distance found, yet
$shortest = -1;

$count = 4;
for ($x = 0; $x <= $count; $x++) {


// loop through words to find the closest
foreach ($words as $word) {

    // calculate the distance between the input word,
    // and the current word
    $lev = levenshtein($input, $word);
    print($lev." is ".$word);
    print("<br />");
    // check for an exact match
    if ($lev == 0) {

        // closest word is this one (exact match)
        $closest = $word;
        $shortest = 0;

        // break out of the loop; we've found an exact match
        break;
    }

    // if this distance is less than the next found shortest
    // distance, OR if a next shortest word has not yet been found
    if ($lev <= $shortest || $shortest < 0) {
        // set the closest match, and shortest distance
        $closest  = $word; # input string က ဟာကို တစ်ခုချင်းလျော့ပြီး ဒီကနေ ညီတဲ့ တူတဲ့တစ်ခုကို ဖြုတ်ပေးနိုင်ရင် ရပြီ
        // if (($key = array_search($closest, $words)) !== false) {
        //     unset($words[$key]);
        // }
        // $words = array_values($words);
        $shortest = $lev;
    }
}

echo "Input word: $input\n";
if ($shortest == 0) {
    echo "Exact match found: $closest\n";
    if (($key = array_search($closest, $words)) !== false) {
        unset($words[$key]);
    }
    $words = array_values($words);
} else {
    echo "Did you mean: $closest?\n";
    if (($key = array_search($closest, $words)) !== false) {
        unset($words[$key]);
    }
    $words = array_values($words);
    echo "<br />";
}



print_r($words);

echo "<h1> The number is: $x </h1><br>";
}

echo "<h1> After </h1>";
print_r($words)

?>

