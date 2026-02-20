<?php

// Note: Format of each error message is array(<error message>)
$_jpg_messages = array(

        1 =>  'Data is too long to fit specified symbol size',
        2 =>  'The BASE256 data is too long to fit available symbol size',
        3 =>  'Data must have at least three characters for C40 encodation',
        4 =>  'Data must have at least three characters for TEXT encodation',
        5 =>  'Internal error: (-5) Trying to read source data past the end',
        6 =>  'Internal error: (-6) Trying to look ahead in data past the end',
        7 =>  'Internal error: (-7) Logic error in TEXT/C40 encodation (impossible branch)',
        8 =>  'The given data can not be encoded using X12 encodation.',
        9 => 'The "tilde" encoded data is not valid.',
        10 => 'Data must have at least three characters for X12 encodation',
        11 => 'Specified data can not be encoded with datamatrix 000 140',
        12 => 'Can not create image',
        13 => 'Invalid color specification',
        14 => 'Internal error: (-14) Index for 140 bit placement matrix out of bounds',
        15 => 'This PHP installation does not support the chosen image encoding format',
        16 => 'Internal error: (-16) Cannot instantiate ReedSolomon',
        20 => 'The specification for shape of matrix is out of bounds (0,29)',
        21 => 'Cannot open the data file specifying bit placement for Datamatrix 200',
        22 => 'Datafile for bit placement is corrupt, crc checks fails.',
        23 => 'Internal error: (-23) Output matrice is not big enough for mapping matrice',
        24 => 'Internal error: (-24) Bit sequence to be placed is too short for the chosen output matrice',
        25 => 'Internal error: (-25) Shape index out of bounds for bit placement',
        26 => 'Cannot open the data file specifying bit placement for Datamatrix 140',
        30 => 'The symbol size specified for ECC140 type Datamatrix is not valid',
        31 => 'Data is to long to fit into any available matrice size for datamatrix 140',
        32 => 'Internal error: (-32) Cannot instantiate MasterRandom',
        33 => 'Internal error: (-33) Failed to randomize 140 bit stream',
        34 => 'Cannot open file %s for writing',
        35 => 'Cannot write to file %s ',
        99 => 'EDIFACT encodation not implemented',
        100 => '<table border="1"><tr><td style="color:darkred; font-size:1.2em;"><b>Datamatrix Error:</b>
HTTP headers have already been sent.<br>Caused by output from file <b>%s</b> at line <b>%d</b>.</td></tr><tr><td><b>Explanation:</b><br>HTTP headers have already been sent back to the browser indicating the data as text before the library got a chance to send it\'s image HTTP header to this browser. This makes it impossible for the Datamatrix library to send back image data to the browser (since that would be interpretated as text by the browser and show up as junk text).<p>Most likely you have some text in your script before the call to <i>DatamatrixBackend::Stroke()</i>. If this texts gets sent back to the browser the browser will assume that all data is plain text. Look for any text (even spaces and newlines) that might have been sent back to the browser. <p>For example it is a common mistake to leave a blank line before the opening "<b>&lt;?php</b>".</td></tr></table>',

);



ksort($_jpg_messages);

echo '<?xml version="1.0" encoding="UTF-8"?>
<?oxygen RNGSchema="http://www.oasis-open.org/docbook/xml/5.0/rng/docbookxi.rng" type="xml"?>
<appendix version="5.0" xmlns="http://docbook.org/ns/docbook"
    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xi="http://www.w3.org/2001/XInclude">
    <info><title>English error messages</title>
        <releaseinfo>$Id$</releaseinfo>
    </info>';


echo "<table frame=\"none\">\n";
echo "<title>English error messages</title>";
echo "<tgroup cols=\"2\">\n" ;
echo "<thead>\n" ;

echo "<row>\n";
echo "     <entry> Error code </entry>\n";
echo "     <entry> Error message </entry>\n";
echo "</row>\n";
echo "</thead>\n" ;
echo "<tbody>\n" ;

foreach ($_jpg_messages as $key => $val ) {

    echo "<row>\n";
    echo "     <entry><code>$key</code></entry>\n";
    echo "     <entry role=\"errmsg\">$val</entry>\n";
    echo "</row>\n";

}

echo "</tbody>\n" ;
echo "</tgroup>\n" ;
echo "</table>\n";
echo "</appendix>\n";



?>

