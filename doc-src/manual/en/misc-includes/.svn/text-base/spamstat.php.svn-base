#!/usr/bin/php
<?php
require_once 'jpgraph/jpgraph.php';
require_once 'jpgraph/jpgraph_bar.php';
require_once 'jpgraph/jpgraph_line.php';

DEFINE('FTP_SERVER','aditus.nu');
DEFINE('FTP_UID','aditus');
DEFINE('FTP_PWD','Psion3a');

DEFINE('PROCMAIL_LOGFILE','/tmp/procmail-ljp-200907.log');
DEFINE('WINDOWSIZE',14); // nbr days window
DEFINE('IMGFILE','/tmp/spamstat.png');

DEFINE('FTP_DIR','www/jpgraph/img/');

// Don't use image error handler, use syslog
JpGraphError::SetImageFlag(false);
JpGraphError::SetLogFile('syslog');

/**
* Class ParseProcmailLogFile
*/
class ParseProcmailLogFile {
    private $iFileName='';
    /**
    * Constructor for the parse class
    *
    * @param mixed $aFileName  Log file to read
    * @return ParseProcmailLogFile
    */
    function __construct($aFileName) {
        $this->iFileName = $aFileName ;
    }
    /**
    * Get line without trailing "\n"
    *
    * @param mixed $fp Filepointer
    * @return string Read line without trailing "\n"
    */
    function GetLine($fp) {
        $s = fgets($fp);
        return substr($s,0,strlen($s)-1);
    }
    /**
    * Get statistics from the parsed log file
    *
    * @param $aWindow Window size. How many days to include in the returned stats
    * @return array with (date, number of killed spam, number of non killed spams)
    */
    function GetStat($aWindow) {

        $fp = fopen($this->iFileName,'r');
        if( $fp === false ) {
            JpGraphError::Raise('Cannot read log file');
        }

        // Now loop through the file. We always keep the last 3 lines in
        // the buffer to be able to get the context of a line since the
        // folder is stored on one line and the date of the main on the
        // previous line
        $buf[1] = $this->GetLine($fp);
        $buf[2] = $this->GetLine($fp);

        $idx = 0;
        $idx2 = 0;
        $found = array(); // All /dev/null spam headers
        $found2 = array(); // All Spam folder headers

        // Loop through all lines in the file and store the found emails
        // in the two $found arrays
        while( ! feof($fp) ) {

            //Shift buffer one step
            $buf[0] = $buf[1];
            $buf[1] = $buf[2];
            $buf[2] = $this->GetLine($fp);

            // Find /dev/null entries
            if( strpos($buf[2],'Folder: /dev/null') !== false ) {
                if( strpos($buf[0],'From ') !== false ) {
                    $datepos = 0 ;
                }
                elseif( strpos($buf[1],'From ') !== false ) {
                    $datepos = 1 ;
                }
                else {
                    continue;
                }
                $date = strtotime(date('D j M Y',strtotime(substr($buf[$datepos],-24))));
                $found[$idx++] = array(str_replace(' Subject: ','',$buf[1]),$date);
            }

            // Find spam folder entries
            if( strpos($buf[2],'.Spam') !== false ) {
                if( strpos($buf[0],'From ') !== false ) {
                    $datepos = 0 ;
                }
                elseif( strpos($buf[1],'From ') !== false ) {
                    $datepos = 1 ;
                }
                else {
                    continue;
                }
                $date = strtotime(date('D j M Y',strtotime(substr($buf[$datepos],-24))));
                $found2[$idx2++] = array(str_replace(' Subject: ','',$buf[1]),$date);
            }

        }

        fclose($fp);

        // Find out how many at each day of dev null
        $date = $found[0][1];
        $daystat[$date] = 0;

        for($i=0; $i < $idx; ++$i ) {
            if( $date == $found[$i][1] ) {
                ++$daystat[$date];
            }
            else {
                $date = $found[$i][1];
                $daystat[$date] = 1;
            }
        }

        // Find out how many at each day of spam
        $daystat2 = array();
        if( count($found2) > 0 ) {
            $date = $found2[0][1];
            $daystat2[$date] = 0;

            for($i=0; $i < $idx2; ++$i ) {
                if( $date == $found2[$i][1] ) {
                    ++$daystat2[$date];
                }
                else {
                    $date = $found2[$i][1];
                    $daystat2[$date] = 1;
                }
            }
        }

        // Now make sure that both arrays have the same
        // number of entries.
        foreach( $daystat as $key => $val ) {
            if( !isset($daystat2[$key]) ) {
                $daystat2[$key] = 0;
            }
        }

        foreach( $daystat2 as $key => $val ) {
            if( !isset($daystat[$key]) ) {
                $daystat[$key] = 0;
            }
        }

        // Window and return the data
        $n = count($daystat);
        $start = $n > $aWindow ? $n - $aWindow : 0;
        $date_keys = array_keys($daystat);
        $idx=0;

        $datax = array(); $datay1 = array(); $datay2 = array();
        for( $i=$start; $i < $n; ++$i ) {
            $datax[$idx] = date('D j M',$date_keys[$i]);
            $datay1[$idx] = $daystat[$date_keys[$i]];
            $datay2[$idx++] = $daystat2[$date_keys[$i]];
        }

        return array($datax,$datay1,$datay2);
    }
}
/**
* Class SpamGraph
*/
class SpamGraph {
    /**
    * Create an accumulated bar graph
    *
    * @param mixed $aFile File to write graph to
    * @param mixed $aXData Date x-labels
    * @param mixed $aYData Spam data 1 (/dev/null)
    * @param mixed $aY2Data Spam data 2 (Spam folder)
    */
    static function Create($aFile,$aXData,$aYData,$aY2Data) {

        $graph = new Graph(650,420);
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
/**
* Class FTP
*/
class FTP {
    private $iserver='', $iuid='',$ipwd='';
    function __construct($aServer,$aUID,$aPWD) {
        $this->iserver = $aServer;
        $this->iuid = $aUID;
        $this->ipwd = $aPWD;
    }
    function Upload($aFile,$aUploadDir) {
        $conn_id = @ftp_connect($this->iserver);

        if ( !$conn_id ) {
            JpGraphError::Raise("FTP connection failed.\nAttempted to connect to {$this->iserver} for user {$this->iuid}.");
        } else {
            syslog(LOG_INFO,"Connected to {$this->iserver}");
        }
        $login_result = ftp_login($conn_id, $this->iuid, $this->ipwd);
        if ((!$conn_id) || (!$login_result)) {
            JpGraphError::Raise("FTP login has failed.\nAttempted to connect to {$this->iserver} for user {$this->iuid}.",3);
        } else {
            syslog(LOG_INFO,"Logged in to {$this->iserver}");
        }

        // Delete potential old file
        $ftp_file = $aUploadDir.basename($aFile);
        $res = @ftp_delete($conn_id,$ftp_file);
        syslog(LOG_INFO,"Uploading image as $aFile");

        // Upload new image
        $upload = ftp_put($conn_id, $ftp_file, $aFile, FTP_BINARY);
        if (!$upload) {
            JpGraphError::Raise("FTP upload of image failed.");
        } else {
            syslog(LOG_INFO,"Succesfully uploaded $aFile to {$this->iserver}.");
        }

        @ftp_close($conn_id);
    }
}

// Step 1) Get the statistics
$parser = new ParseProcmailLogFile(PROCMAIL_LOGFILE);
list($xdata, $ydata, $y2data) = $parser->GetStat(WINDOWSIZE);


// Step 2) Create the graph
SpamGraph::Create(IMGFILE,$xdata,$ydata,$y2data);

// Step 3) Upload the file if defined
if( IMGFILE !== '' ) {
    $ftp = new FTP(FTP_SERVER,FTP_UID,FTP_PWD);
    $ftp->Upload(IMGFILE,FTP_DIR);
}

?>
