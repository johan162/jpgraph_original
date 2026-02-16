<?php
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');

$ydata = array(11,3,8,12,5,1,9,13,5,7);
$y2data = array(354,200,265,99,111,91,198,225,293,251);

// Create the graph and specify the scale for both Y-axis
$width=550;$height=400;
$graph = new Graph(550,400);
$graph->SetScale('textlin');
$graph->SetY2Scale('lin');
$graph->SetShadow();

// Adjust the margin
$graph->SetMargin(50,150,60,80);

// Create the two linear plot
$lineplot=new LinePlot($ydata);
$lineplot2=new LinePlot($y2data);

// Add the plot to the graph
$graph->Add($lineplot);
$graph->AddY2($lineplot2);
$lineplot2->SetColor('orange');
$lineplot2->SetWeight(2);

// Adjust the axis color
$graph->y2axis->SetColor('darkred');
$graph->yaxis->SetColor('blue');

$graph->title->SetFont(FF_ARIAL, FS_BOLD, 14);
$graph->title->Set('Using JpGraph Library');
$graph->title->SetMargin(10);

$graph->subtitle->SetFont(FF_ARIAL, FS_BOLD, 10);
$graph->subtitle->Set('(common objects)');

$graph->xaxis->title->SetFont(FF_ARIAL, FS_BOLD, 10);
$graph->xaxis->title->Set('X-title');
$graph->yaxis->title->SetFont(FF_ARIAL, FS_BOLD, 10);
$graph->yaxis->title->Set('Y-title');

// Set the colors for the plots
$lineplot->SetColor('blue');
$lineplot->SetWeight(2);
$lineplot2->SetColor('darkred');
$lineplot2->SetWeight(2);

// Set the legends for the plots
$lineplot->SetLegend('Plot 1');
$lineplot2->SetLegend('Plot 2');

// Adjust the legend position
$graph->legend->SetPos(0.05,0.5,'right','center');

// Display the graph
$graph->Stroke();
?>
