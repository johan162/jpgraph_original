<?php


echo '<?xml version="1.0" encoding="UTF-8"?>
<?oxygen RNGSchema="http://www.oasis-open.org/docbook/xml/5.0/rng/docbookxi.rng" type="xml"?>
<appendix version="5.0" xmlns="http://docbook.org/ns/docbook"
    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xi="http://www.w3.org/2001/XInclude">';

echo "<title>List of files included in the library</title>\n";
echo "<para></para>";
echo '<table frame="none">';
echo '<title>List of files included in the library</title>';
echo "<tgroup cols=\"2\">\n";
echo "<thead>\n";
echo '<row>';
echo '<entry>File name</entry>';
echo '<entry>Description</entry>';
echo "</row>\n";
echo "</thead>\n";

echo "<tbody>";


$lines = file("files.txt",FILE_IGNORE_NEW_LINES);


foreach( $lines as $key => $filename ) {

    echo "<row>\n";

    echo "    <entry><filename>$filename</filename></entry>\n";
    echo "    <entry>text</entry>\n";

    echo "</row>\n";

}

echo "</tbody>\n";
echo "</tgroup>\n";
echo "</table>";

echo "<para></para>";

$lines = file("dirs.txt",FILE_IGNORE_NEW_LINES);

echo '<table frame="none">';
echo '<title>List of subdirectories in main src directory</title>';
echo "<tgroup cols=\"2\">\n";
echo "<thead>\n";
echo '<row>';
echo '<entry>Directory</entry>';
echo '<entry>Description</entry>';
echo "</row>\n";
echo "</thead>\n";

echo "<tbody>";

foreach( $lines as $key => $filename ) {

    echo "<row>\n";

    echo "    <entry><filename>$filename</filename></entry>\n";
    echo "    <entry>text</entry>\n";

    echo "</row>\n";

}

echo "</tbody>\n";
echo "</tgroup>\n";
echo "</table>";



echo "\n</appendix>\n";



?>
