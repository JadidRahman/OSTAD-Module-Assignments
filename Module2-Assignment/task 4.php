<?php
function generateFibonacci($n) {
    $fibonacciSequence = [];
    
    for ($i = 0; $i < $n; $i++) {
        if ($i <= 1) {
            $fibonacciSequence[] = $i;
        } else {
            $fibonacciSequence[] = $fibonacciSequence[$i - 1] + $fibonacciSequence[$i - 2];
        }
    }

    return $fibonacciSequence;
}

$fibonacciNumbers = generateFibonacci(15);
echo implode(', ', $fibonacciNumbers);
?>
