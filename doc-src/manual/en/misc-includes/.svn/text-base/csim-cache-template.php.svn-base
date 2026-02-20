<?php
require_once( 'jpgraph.php');

// ... any necessary includes

$width = ...
$height = ...
$graph = new Graph($width,$height);

// Check cache and use a 10 min timeout
$graph->CheckCSIMCache('csim_image1',10);

// If a cached version exists, execution halts here
// and the cached HTML image map is sent back

// ... construct and format the graph

// ... finally send back the image map HTML script
$graph->StrokeCSIM();
?>
