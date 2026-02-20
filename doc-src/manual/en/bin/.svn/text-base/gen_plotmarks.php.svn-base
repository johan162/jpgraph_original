<?php
include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_plotmark.inc.php");
include ("jpgraph/jpgraph_canvas.php");

// Setup a canvas graph
$graph = new CanvasGraph(700,100);
$graph->SetMarginColor('white');
$graph->SetFrame(true,'gray');
$graph->StrokeFrame();

/*
// SBALL
$colors = array('bluegreen','cyan','darkgray','greengray',
     'gray','graypurple','green','greenblue','lightblue',
     'lightred','navy','orange','purple','red','yellow');
*/

/*
// MBALL
$colors = array('blue','bluegreen','brown','cyan','darkgray','greengray','gray','green','greenblue','lightblue','lightred', 'purple','red','white','yellow');
*/

/*
// LBALL
$colors = array('blue','lightblue','brown','darkgreen',
                  'green','purple','red','gray','yellow','silver','gray');
*/
/*
// BEVELS
$colors = array('green','purple','orange','red','yellow');
*/

/*
// DIAMONDS
$colors = array('lightblue','darkblue','gray',
   'blue','pink','purple','red','yellow');
*/

/*
// PUSHPINS
$colors = array('blue','green','orange','pink','red');
*/

/*
// SQUARES
$colors = array('bluegreen','blue','green',
   'lightblue','orange','purple','red','yellow');
*/

// STAR
$colors = array('bluegreen','lightblue','purple','blue','green','pink','red','yellow');

$n = count($colors);
$marker = new PlotMark();
$title = new Text();
$title->SetAlign('center','bottom');

$title->SetFont(FF_ARIAL,FS_BOLD,12);
$title->Set('Supported colors for:');
$title->Stroke($graph->img,270,20);

$title->SetFont(FF_COURIER,FS_BOLD,12);
$title->Set('MARK_IMG_STAR');
$title->SetColor('darkred');
$title->Stroke($graph->img,440,21);


$lbl = new Text();
$lbl->SetFont(FF_ARIAL,FS_NORMAL,8);
$lbl->SetAlign('center','bottom');

$startx = round(360 - ($n *45)/2);
for($i=0; $i < $n ; ++$i) {
        $marker->SetType(MARK_IMG_STAR,$colors[$i]);
        $lbl->Set($colors[$i]);
        $marker->Stroke($graph->img,$startx+$i*45,45);
        if($i % 2  == 0 ) {
                $lbl->Stroke($graph->img,$startx+$i*45,90);
        }
        else {
                $lbl->Stroke($graph->img,$startx+$i*45,75);
        }
}

// Output line
$graph->Stroke();
?>
