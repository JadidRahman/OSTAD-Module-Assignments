<?php

for ($i = 1; $i <= 50; $i++) {
    if ($i % 5 == 0) {
        // Skip multiples of 5
        continue;
    }
    echo $i . " ";
}

?>
