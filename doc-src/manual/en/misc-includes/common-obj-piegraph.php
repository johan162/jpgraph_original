<?php
include ("../jpgraph.php");
include ("../jpgraph_pie.php");

// Some data
$data = array(50,15,25,10,31,20);

// A new graph
$graph = new PieGraph(400,420);
$graph->SetAntiAliasing();

$graph->title->SetFont(FF_ARIAL, FS_BOLD, 14);
$graph->title->Set('Using JpGraph Library');
$graph->title->SetMargin(10);

$graph->subtitle->SetFont(FF_ARIAL, FS_BOLD, 10);
$graph->subtitle->Set('(common objects)');

// The pie plot
$p1 = new PiePlot($data);
$p1->SetSliceColors(array('darkred','navy','lightblue','orange','gray','teal'));

// Move center of pie to the left to make better room
// for the legend
$p1->SetSize(0.3);
$p1->SetCenter(0.5,0.47);
$p1->value->Show();
$p1->value->SetFont(FF_ARIAL,FS_NORMAL,10);

// Legends
$p1->SetLegends(array("May (%1.1f%%)","June (%1.1f%%)","July (%1.1f%%)","Aug (%1.1f%%)",
"Sep (%1.1f%%)", "Oct (%1.1f%%)"));
$graph->legend->SetPos(0.5,0.97,'center','bottom');
$graph->legend->SetColumns(3);

$graph->Add($p1);
$graph->Stroke();
?>


