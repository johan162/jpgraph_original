<?php

require_once('jpgraph/jpgraph_rgb.inc.php');

$rgb = new RGB();

ksort($rgb->rgb_table);
$n = count($rgb->rgb_table);

echo '<?xml version="1.0" encoding="UTF-8"?>
<?oxygen RNGSchema="http://www.oasis-open.org/docbook/xml/5.0/rng/docbookxi.rng" type="xml"?>
<appendix version="5.0" xmlns="http://docbook.org/ns/docbook"
    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xi="http://www.w3.org/2001/XInclude"
    xml:id="app.named-colors">
 <title>Named color list</title>
     <para> See <xref xlink:href="#chap.color-handling"/> for a discussion on how to specify colors
          for graphic objects in the graph.</para>';
echo "\n";
echo "<table frame=\"none\">\n";
echo "<title>Named color list</title>";
echo "<tgroup cols=\"4\">\n" ;
echo "<thead>\n" ;

echo "<row>\n";
echo "     <entry> Color name </entry>\n";
echo "     <entry> RGB Triple </entry>\n";
echo "     <entry> Hex </entry>\n";
echo "     <entry> Color </entry>\n";
echo "</row>\n";
echo "</thead>\n" ;
echo "<tbody>\n" ;

foreach ($rgb->rgb_table as $key => $val ) {

    $hex = sprintf("%02x",$val[0]).sprintf("%02x",$val[1]).sprintf("%02x",$val[2]);

    echo "<row>\n";
    echo "     <entry>$key</entry>\n";
    echo "     <entry>($val[0],$val[1],$val[2])</entry>\n";
    echo "     <entry><constant>#$hex</constant></entry>\n";
    echo "     <entry role=\"named-color\"> <?dbhtml-include href=\"../colors/color-$hex.html\" ?> </entry>\n";
    echo "</row>\n";

    $fp = fopen("colors/color-$hex.html","w");
    $buf = "<span style=\"background:#$hex;color:#$hex;\">COLOR</span>";
    fwrite($fp,$buf);
    fclose($fp);

}

echo "</tbody>\n" ;
echo "</tgroup>\n" ;
echo "</table>\n";
echo "</appendix>\n";
?>
