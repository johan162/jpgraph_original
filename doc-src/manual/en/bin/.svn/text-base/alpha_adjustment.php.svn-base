<?php
// Show color brighness adjustment
include "../jpgraph.php";
include "../jpgraph_canvas.php";

$w=520;
$h=110;
$g = new CanvasGraph($w,$h);

$g->img->SetColor('gray');
$g->img->Rectangle(0,0,$w-1,$h-1);

$basecolor='blue';
$colors = array($basecolor.'@0.0:1.4',$basecolor.'@0.2',$basecolor.'@0.4',
$basecolor.'@0.6',$basecolor.'@0.8',$basecolor.'@1.0');
$n = count ( $colors );
$x=10; $y=10;

$t = new Text('',0,0);
$t->SetFont(FF_ARIAL,FS_NORMAL,10);

$t->Align("center","top");
$t->ParagraphAlign("center");

$g->img->SetColor('red');
$g->img->FilledRectangle(5,25,$w-6,65);


for( $i=0; $i < $n; ++$i ) {
    
    $g->img->SetColor($colors[$i]);
    $g->img->FilledRectangle($x,$y,$x+70,$y+70);
    $g->img->SetColor('darkgray');
    $g->img->Rectangle($x,$y,$x+70,$y+70);
    
    $t->Set('"'.$colors[$i].'"');
    $t->Stroke($g->img,$x+35,$y+75);

    $x+=85;    
}

$g->Stroke();

?>

