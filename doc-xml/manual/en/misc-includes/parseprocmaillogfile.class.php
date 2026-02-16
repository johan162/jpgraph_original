<?php
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
                // Aggregate all the data per day
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
                // Aggregate all the data per day
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
?>