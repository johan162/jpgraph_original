<?php
// Just keep the last 20 values in the arrays
$year = array_slice($year, -20);
$ydata = array_slice($ydata, -20);

// ...

// Specify what scale we want to use,
// text = txt scale for the X-axis
// int = integer scale for the Y-axis
$graph->SetScale('textint');

// ...
?>
