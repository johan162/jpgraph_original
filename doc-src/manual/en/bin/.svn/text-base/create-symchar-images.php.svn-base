<?php
// Show available symbol in SymChar class
include "jpgraph/jpgraph.php";
include "jpgraph/jpgraph_canvas.php";

$symbols = array(
    /* Greek */
    array('alpha','03B1','0391'),
    array('beta','03B2','0392'),
    array('gamma','03B3','0393'),
    array('delta','03B4','0394'),
    array('epsilon','03B5','0395'),
    array('zeta','03B6','0396'),
    array('ny','03B7','0397'),
    array('eta','03B8','0398'),
    array('theta','03B8','0398'),
    array('iota','03B9','0399'),
    array('kappa','03BA','039A'),
    array('lambda','03BB','039B'),
    array('mu','03BC','039C'),
    array('nu','03BD','039D'),
    array('xi','03BE','039E'),
    array('omicron','03BF','039F'),
    array('pi','03C0','03A0'),
    array('rho','03C1','03A1'),
    array('sigma','03C3','03A3'),
    array('tau','03C4','03A4'),
    array('upsilon','03C5','03A5'),
    array('phi','03C6','03A6'),
    array('chi','03C7','03A7'),
    array('psi','03C8','03A8'),
    array('omega','03C9','03A9'),
    /* Money */
    array('euro','20AC'),
    array('yen','00A5'),
    array('pound','20A4'),
    /* Math */
    array('approx','2248'),
    array('neq','2260'),
    array('not','2310'),
    array('def','2261'),
    array('inf','221E'),
    array('sqrt','221A'),
    array('int','222B'),
    /* Misc */
    array('copy','00A9'),
    array('para','00A7'),
    array('tm','2122'),   /* Trademark symbol */
    array('rtm','00AE')   /* Registered trademark */

    );


$w=290;
$h=225;
$g = new CanvasGraph($w,$h);

$g->img->SetColor('gray');
$g->img->Rectangle(0,0,$w-1,$h-1);

$n = count ( $symbols );
$x=10; $y=10;

$t = new Text('',0,0);
$t->SetFont(FF_TIMES,FS_NORMAL,14);

$t->Align("center","center");
$t->ParagraphAlign("center");
$capital=true;

for( $i=1; $i <= $n; ++$i ) {

    $g->img->SetColor('black');
    $g->img->SetColor('darkgray');
    $g->img->Rectangle($x,$y,$x+25,$y+25);

    $t->Set(SymChar::Get($symbols[$i-1][0],$capital));
    $t->Stroke($g->img,$x+12,$y+12);

    $x+=30;

    if( $i ==9 || $i == 18 || $i == 25 || $i == 28 || $i == 35 ) { $y += 30; $x = 10; }
    if( $i == 25 || $i == 28 || $i == 35 ) $y += 10;
}

$g->Stroke();

?>

