<?php
$grades = array(85, 92, 78, 88, 95);

function sortGradesDescending($inputArray) {
    arsort($inputArray);
    return $inputArray;
}
$sortedGrades = sortGradesDescending($grades);
$output = "Array\n(\n";
foreach ($sortedGrades as $key => $value) {
    $output .= "    [$key] => $value\n";
}
$output .= ")\n";
$outputHTML = nl2br($output);
echo $outputHTML;
?>
