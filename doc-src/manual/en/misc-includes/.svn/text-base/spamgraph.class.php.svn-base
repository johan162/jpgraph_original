<?php
/**
* Class SpamGraph
*/
class SpamGraph {
	private $iWidth, $iHeight;
	/**
	* Constructor
	* 
	* @param $aWidth Width of generated graph
	* @param $aHeight Height of generated graph
	* @return SpamGraph 
	*/
	public function __construct($aWidth,$aHeight) {
		$this->iWidth = $aWidth;
		$this->iHeight = $aHeight;
	} 
    /**
    * Create an accumulated bar graph
    * 
    * @param string $aFile File to write graph to
    * @param array $aXData Date x-labels
    * @param array $aYData Spam data 1 (/dev/null)
    * @param array $aY2Data Spam data 2 (Spam folder)
    */
    public function Create($aFile,$aXData,$aYData,$aY2Data) {

        $graph = new Graph($this->iWidth,$this->iHeight);    
        $graph->SetMargin(40,20,50,110); 
        $graph->SetScale('textint');
        $graph->SetMarginColor('khaki2@0.6');

        $graph->legend->SetPos(0.5,0.97,'center','bottom');
        $graph->legend->SetLayout(10);
        $graph->legend->SetFillColor('white');
        $graph->legend->SetFont(FF_ARIAL,FS_NORMAL,10);

        $graph->title->Set('Identified spams');
        $graph->title->SetMargin(10);
        $graph->title->SetFont(FF_ARIAL,FS_NORMAL,14);

        $graph->subtitle->Set('(Updated: '.date('j M Y, H:i'.' T)'));
        $graph->subtitle->SetMargin(5);
        $graph->subtitle->SetFont(FF_ARIAL,FS_ITALIC,11);

        $graph->xaxis->SetTickLabels($aXData);
        $graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
        $graph->xaxis->SetLabelAngle(45);

        $graph->yaxis->SetFont(FF_ARIAL,FS_NORMAL,10);
        $graph->yscale->SetGrace(10);

        $bar1 = new BarPlot($aYData);
        $bar1->SetFillGradient('darkred:1.2','darkred:0.7',GRAD_VER);
        $bar1->SetLegend('To "/dev/null"');

        $bar2 = new BarPlot($aY2Data);
        $bar2->SetFillGradient('orange','orange:0.7',GRAD_VER);
        $bar2->SetLegend('To Spam folder');

        $abar = new AccBarPlot(array($bar1,$bar2));
        $abar->value->Show();
        $abar->value->SetFormat('%d');
        $graph->Add($abar);
        $graph->Stroke($aFile);
        
        syslog(LOG_INFO,"Created spam image in $aFile."); 
    }
}
  
?>
