<?php
 // Width and height of the graph
$width = 600; $height = 200;

// Create a graph instance
$graph = new Graph($width,$height);

// Specify what scale we want to use,
// int = integer scale for the X-axis
// int = integer scale for the Y-axis
$graph->SetScale('intint');

// Setup a title for the graph
$graph->title->Set('Sunspot example');

// Setup titles and X-axis labels
$graph->xaxis->title->Set('(year from 1701)');

// Setup Y-axis title
$graph->yaxis->title->Set('(# sunspots)');

// Create the linear plot
$lineplot=new LinePlot($ydata);

// Add the plot to the graph
$graph->Add($lineplot);

// Display the graph
$graph->Stroke();
?>
