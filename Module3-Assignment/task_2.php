<?php
$numbers = range(1, 10);

function removeEvenNumbers($inputArray) {
    $resultArray = array();
    foreach ($inputArray as $number) {
        if ($number % 2 != 0) {
            $resultArray[] = $number;
        }
    }
    return $resultArray;
}

$filteredNumbers = removeEvenNumbers($numbers);
echo "<pre>";
print_r($filteredNumbers);
echo "</pre>";
?>
