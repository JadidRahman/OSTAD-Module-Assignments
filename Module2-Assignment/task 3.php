<?php
function fibonacci($n) {
    if ($n <= 1) {
        return $n;
    } else {
        return fibonacci($n - 1) + fibonacci($n - 2);
    }
}

$fibonacciSequence = [];

for ($i = 0; count($fibonacciSequence) < 10; $i++) {
    $fib = fibonacci($i);
    
    if ($fib > 100) {
        break;
    }

    $fibonacciSequence[] = $fib;
}

foreach ($fibonacciSequence as $fib) {
    echo $fib . " ";
}
?>
