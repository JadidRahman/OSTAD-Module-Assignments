<?php
$studentGrades = array(
    "Student1" => array("Math" => 85, "English" => 90, "Science" => 88),
    "Student2" => array("Math" => 78, "English" => 92, "Science" => 85),
    "Student3" => array("Math" => 92, "English" => 87, "Science" => 94)
);

function calculateAverageGrades($gradesArray) {
    foreach ($gradesArray as $student => $grades) {
        $total = array_sum($grades);
        $count = count($grades);
        $average = $total / $count;
        
        echo "Average grade for $student: $average\n";
    }
}
calculateAverageGrades($studentGrades);
?>
