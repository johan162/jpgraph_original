<?php
// ...

// Label callback
function year_callback($aLabel) {
    return 1700+(int)$aLabel;
}

// ...

$graph->xaxis->SetLabelFormatCallback('year_callback');

// ...

?>
