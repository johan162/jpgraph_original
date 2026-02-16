<?php

// Note: Format of each error message is array(<error message>)
$_jpg_messages = array(
    /* Backend errors */
    1000 => 'Tilde processing is not yet supported for QR Barcodes.',
    1001 => 'Inverting the bit pattern is not supported for QR Barcodes.',
    1002 => 'Cannot read data from file %s',
    1003 => 'Cannot open file %s',
    1004 => 'Cannot write QR barcode to file %s',
    1005 => 'Unsupported image format selected. Check your GD installation',
    1006 => 'Cannot set the selected barcode colors. Check your GD installation and spelling of color name',
    1007 => '<table border="1"><tr><td style="color:darkred; font-size:1.2em;"><b>Datamatrix Error:</b>
HTTP headers have already been sent.<br>Caused by output from file <b>%s</b> at line <b>%d</b>.</td></tr><tr><td><b>Explanation:</b><br>HTTP headers have already been sent back to the browser indicating the data as text before the library got a chance to send it\'s image HTTP header to this browser. This makes it impossible for the Datamatrix library to send back image data to the browser (since that would be interpretated as text by the browser and show up as junk text).<p>Most likely you have some text in your script before the call to <i>DatamatrixBackend::Stroke()</i>. If this texts gets sent back to the browser the browser will assume that all data is plain text. Look for any text (even spaces and newlines) that might have been sent back to the browser. <p>For example it is a common mistake to leave a blank line before the opening "<b>&lt;?php</b>".</td></tr></table>',
    1008 => 'Could not create the barcode image with image format=%s. Check your GD/PHP installation.',
    1009 => 'Cannot open log file %s for writing.',
    1010 => 'Cannot write log info to log file %s.',

    /* Mask error */
    1100 => 'Internal error: Illegal mask pattern selected',
    1101 => 'Internal error: Trying to apply masking to functional pattern.',
    1102 => 'Internal error: applyMaskAndEval(): Found uninitialized module in matrix when applying mask pattern.',

    /* Layout error  */
    1200 => 'Internal error: Was expecting %d bits in version %d to be placed in matrix but got %d bits',
    1201 => 'Internal error: Trying to position bit outside the matrix x=%d, y=%d, size=%d, bIdx=%d',
    1202 => 'Internal error: Trying to put data in initialized bit.',
    1203 => 'Internal error: Mask number for format bits is invalid. (maskidx=%d)',
    1204 => 'Internal error: Found an uninitilized bit [val=%d] at (%d,%d) when flattening matrix',

    /* Capacity error */
    1300 => 'Internal error: QRCapacity::getFormatBits() Was expecting a format in range [0,31] got %d',
    1301 => 'Internal error: QRCapacity::getVersionBits() Was expecting a version in range [7,40] got %d',
    1302 => 'Internal error: QRCapacity::_chkVerErr() Was expecting version in range [1,40] and error level in range [0,3] got (%d,%d)',
    1303 => 'Internal error: QRCapacity::getAlignmentPositions() Expected %d patterns but found %d patterns (len=%d).',
    1304 => 'Internal error: QRCapacity::%s Was expecting a version in range [1,40] got %d',

    /* Encoder errors */
    1400 => 'QR Version must be specified as a value in the range [1,40] got %d',
    1401 => 'Input data to barcode can not be empty.',
    1402 => 'Automatic encodation mode was specified but input data looks like specification for manual encodation.',
    1403 => 'Was expecting an array of arrays as input data for manual encoding.',
    1404 => 'Each input data array element must consist of two entries. Element $i has of $nn entries',
    1405 => 'Each input data array element must consist of two entries with first entry being the encodation constant and the second element the data string. Element %d is incorrect in this respect.',
    1406 => 'Was expecting either a string or an array as input data',
    1407 => 'Manual encodation mode was specified but input data looks like specification for automatic encodation.',
    1408 => 'Input data too large to fit into one QR Symbol',
    1409 => 'The selected symbol version %d is too small to fit the specied data and selected error correction level.',
    1410 => 'Trying to read past the last available codeword in block split.',
    1411 => 'Internal error: Expected 1 or 2 as the number of block structures.',
    1412 => 'Internal error: Too many codewords for chosen symbol version. (negative number of pad codewords).',
    1413 => 'Internal error: splitInBytes: Expected an even number of 8-bit blocks.',
    1414 => 'Internal error: getCountBits() illegal version number (=%d).',
    1415 => 'Manually specified encodation schema MODE_NUMERIC has no data that can be encoded using this schema.',
    1416 => 'Manually specified encodation schema MODE_ALPHANUM has no data that can be encoded using this schema.',
    1417 => 'Manually specified encodation schema MODE_BYTE has no data that can be encoded using this schema.',
    1418 => 'Unsupported encodation schema specified (%d)',
    1419 => 'Found character in data stream that cannot be encoded with the selected manual encodation mode.',
    1420 => 'Encodation using KANJI mode not yet supported.',
    1421 => 'Internal error: Unsupported encodation mode doAuto().',
    1422 => 'Found unknown characters in the data strean that can\'t be encoded with any available encodation mode.',
    1423 => 'Kanji character set not yet supported.',
    1424 => 'Internal error: DataStorage:: Unsupported character mode (%d) DataStorage::Remaining()',
    1425 => 'Internal error: DataStorage:: Trying to extract slice of len=%d (with type=%d) when there are only %d elements left',
    1426 => 'Internal error: DataStorage:: Trying to read past input data length.',
    1427 => 'Expected either DIGIT, ALNUM or BYTE but found ASCII code=%d',
    1428 => 'Internal error: DataStorage::Peek() Trying to peek past input data length.',

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

