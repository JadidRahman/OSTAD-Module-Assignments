<?php
// using a for loop
function printEvenNumbersFor($start, $end, $step) {
    for ($i = $start; $i <= $end; $i += $step) {
        echo $i . " ";
    }
    echo PHP_EOL; 
}

// using a while loop
function printEvenNumbersWhile($start, $end, $step) {
    $i = $start;
    while ($i <= $end) {
        echo $i . " ";
        $i += $step;
    }
    echo PHP_EOL; // Add a new line after printing
}

//  using a do-while loop
function printEvenNumbersDoWhile($start, $end, $step) {
    $i = $start;
    do {
        echo $i . " ";
        $i += $step;
    } while ($i <= $end);
    echo PHP_EOL; 
}


echo "Using for loop: ";
printEvenNumbersFor(2, 20, 2);

echo "Using while loop: ";
printEvenNumbersWhile(2, 20, 2);

echo "Using do-while loop: ";
printEvenNumbersDoWhile(2, 20, 2);
?>
