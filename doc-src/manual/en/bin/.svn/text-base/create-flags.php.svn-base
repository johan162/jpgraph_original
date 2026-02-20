<?php
// List all current supported flags.
include "jpgraph/jpgraph.php";
include "jpgraph/jpgraph_flags.php";

echo '<?xml version="1.0" encoding="UTF-8"?>
<?oxygen RNGSchema="http://www.oasis-open.org/docbook/xml/5.0/rng/docbookxi.rng" type="xml"?>
<appendix version="5.0" xmlns="http://docbook.org/ns/docbook"
    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xi="http://www.w3.org/2001/XInclude">';

echo "<title>List of all country flags</title>\n";
echo "<para>The list of all flags are in simple alphabetical order,
i.e. by the full name including governance prefix e.g. \"Republic\".
The size of the flags in this table has been chosen as <code>FLAGSIZE2</code> </para>";
echo '<table frame="none">';
echo '<title>List of all country flags</title>';
echo "<tgroup cols=\"4\">\n";
echo "<thead>\n";
echo '<row>';
echo '<entry>Country name</entry>';
echo '<entry>Short name</entry>';
echo '<entry>Index</entry>';
echo '<entry>Flag</entry>';
echo "</row>\n";
echo "</thead>\n";

echo "<tbody>\n";
$flags = new FlagImages(FLAGSIZE2) ;

$idxa = array();
$i=0;
reset($flags->iCountryNameMap);
while( list($key,$val) = each($flags->iCountryNameMap) ) {
    $idxa[$key] = $i++;
}


ksort($flags->iCountryNameMap);

while( list($key,$val) = each($flags->iCountryNameMap) ) {

    $fn = "chapters/flags/flag-$val.png";
    $img = $flags->GetImgByIdx($val);
    //ImagePng ($img,$fn);

    echo "<row>\n";
    echo "    <entry valign=\"middle\" >$key</entry>\n";
    echo "    <entry valign=\"middle\"><code>\"$val\"</code></entry>\n";
    echo "    <entry valign=\"middle\">".$idxa[$key]."</entry>\n";
    echo "    <entry><inlinemediaobject><imageobject><imagedata fileref=\"images/flag-$val.png\" /></imageobject></inlinemediaobject> </entry>\n";
    echo "</row>\n";

}

echo "</tbody>\n";
echo "</tgroup>\n";
echo "</table>\n</appendix>\n";


?>

