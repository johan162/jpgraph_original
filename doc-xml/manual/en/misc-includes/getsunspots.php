<?php
function readsunspotdata($aFile, &$aYears, &$aSunspots) {
    $lines = @file($aFile,FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
    if( $lines === false ) {
        throw new JpGraphException('Can not read sunspot data file.');
    }
    foreach( $lines as $line => $datarow ) {
        $split = preg_split('/[\s]+/',$datarow);
        $aYears[] = substr(trim($split[0]),0,4);
        $aSunspots[] = trim($split[1]);
    }
}

$year = array();
$ydata = array();
readsunspotdata('yearssn.txt',$year,$ydata);

?>
