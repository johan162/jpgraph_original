<?php

// ... necessary includes ...

$graph = new Graph(400,300);

// ... code to generate a graph ...

// Get the handler to prevent the library from sending the
// image to the browser
$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

// Stroke image to a file and browser

// Default is PNG so use ".png" as suffix
$fileName = "/tmp/imagefile.png";
$graph->img->Stream($fileName);

// Send it back to browser
$graph->img->Headers();
$graph->img->Stream();
?>
