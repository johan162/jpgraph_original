<?php



// Read FAQ from site and produce docbooks style QandAset
  /*
 <qandaset>
            <qandaentry>
                <question>
                    <para>This is a question</para>
                </question>
                <answer>
                    <para>And this is the answer</para>
                </answer>
            </qandaentry>
            <qandaentry>
                <question>
                    <para>This is a question</para>
                </question>
                <answer>
                    <para>And this is the answer</para>
                </answer>
            </qandaentry>
            <qandaentry>
                <question>
                    <para>This is a question</para>
                </question>
                <answer>
                    <para>And this is the answer</para>
                </answer>
            </qandaentry>

        </qandaset>
  */


$faqs = array(


/* ******************************** */
array('Installation',
/* ******************************** */
      array(
array('Where should I install the library?',
      'The simple answer is: Anywhere You like! Since the necessary library files are included in Your own script with an "include" statement it doesn\'t matter where You put the library as long as Your scripts can access it. A common place is to store the library is in a directory where PHP searches for include files (as specified in Your php.ini file), for example in "/usr/share/php" or perhaps "/usr/local/php" depending on Your PHP configuration. <p> An even simpler way is to just store the library in a directory where Your scripts are executed from.'),

array(
'Can I use JpGraph with Windows/Unix/Linux etc? ',
'Yes. The library itself is OS-agnostic.
As long as you have a WEB server which supports PHP 4.3.x (or
      above) and have the GD library.
Please note though that the behavior of
      PHP/Apache on Unix and Windows seems to have some subtle differences which
      might affect things like path specification using \'/\' or \'\\\'.
'
),

array(
'My webadmin does not allow PHP any write permissions and hence I
      can\'t use the cache feature of JpGraph. Is there any way to completely
      turn off the caching feature?',
'Yes, set the constant "USE_CACHE" to FALSE in jpg-config.php. This way
      will skip writing file even if a filename has been submitted in the
      Graph() creation call. You can also accomplish this by not having any file
      name at all in the call to Graph().'
),

array(
'After installation all I get is an empty page when I try any of the examples?',
'If the HTTP server respons is truly absolutely empty (verify that by looking at the
source of the page that gets returned to the browser) then the only answer
is that the HTTP server has crashed. Most likely it is the PHP process within
the server that has crashed. Even though PHP is fairly stable there are still
ways of crashing it. To investigate this further You might try to:
<ul>
<li> ... investigate the system log for traces of a server crash.
<li> ... try increase the maximum allowed memory for PHP in <i>php.ini</i>.
As a rule it should be a minimum of 16MB (and preferable 32MB).
<li> ... upgrade PHP to the latest stable version (and use the compile options shown
further down in this FAQ.
<li> ... enable all errors and warning for PHP (in <i>php.ini</i>) to help track down the problem.
<li> ... disable output buffering to get errors send back to the browser as soon as
possible (<i>in php.ini</i>).
</ul>

'
),


/* array('Q','A') */

          )),
/* End of Installation */


/* ******************************** */
array('General',
/* ******************************** */

array(

array(
'How can I send the generated graph to both the browser and a file at the same time?',
'This is not directly supported by means of any particular option or setting
in the library but with small "trick" this is easy enough to accomplish.
<p>
The idea is to use the _IMG_HANDLER option that forces the
<tt>Graph::Stroke()</tt> to just return the image handler and then stop. We can then
manually first send the image to the chosen file and then stream it back to the
browser using some internal methods in the library.
<p>
The following code snippet shows how this is done
<pre>
$graph = new Graph(400,300);

<... code to generate a graph ...>

// Get the handler to prevent the library from sending the
// image to the browser
$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

// Stroke image to a file and browser

// Default is PNG so use ".png" as suffix
$fileName = "/tmp/imagefile.png";
$graph->img->Stream($fileName);

// Send it back to browser
$graph->img->Headers();
$graph->img->Stream();

</pre>
'
),


array(
'What is this \'auto\' I see in all the Graph() creating in the Examples directory?
Do I need it?',
'No. The third argument in the graph call is an optional cache file name and is not necessary
unless You want to use the caching feature of JpGraph.
By specifying \'auto\' the filename is automatically
created based on the name of the script file.'
),

array(
      'The Client side image map examples does not work on my machine?' ,
' In order to run the examples the code generates HTML to read the image
      from the cache directory as Apache sees it. You must adjust the image tag
      to have the correct path to your cache directory. '
),

array(
'When I run \'testsuit_jpgraph.php\' I get a warning "Due to
      insufficient permission the source files can\'t be automatically created"',
'This is not a serious problem. When the testsuit is run it tries to create
      a symbolic link with the same base name as the individual testfile but
      with extension ".phps". This is just so it is possible to click on an
      image and then view the source syntax colored. If Apache doesn\'t have
      write permissions to the directory where \'testsuit_jpgraph.php\' is
      executed from you will get this warning.<p>
      If you want to use this feature just change the permissions so Apache may
      write to the directory.'
),


array(
' How can I pass data to my image generating script?',
'There are basically three(four) ways:
<ul>
<li> Read the data from a file
<li> Read the data from a DB
<li> Pass the data in the &lt;img&gt; tag using URL parameter passing.
For example
<pre>
&lt;img src="myimg.php?d1=2&d2=7&d3=12" border=0&gt;
</pre>
This method is not suitable for large data sets since there is an upper
        bound to the length of an URL specification (around 255 characters)
<li>  A fourth way might be to use
        session variables to pass the data between different scripts.
      For large data sets the only practical way is to read the data from a file
      or from a DB to construct the data vectors.
</ul>
'
),


array(
'How can I use data from an Excel spreadsheet?',
'Export the data from Excel as a CSV (Comma separated Values) file to be able
to easily read the file. Then either write your own routine to read and parse the data
from that file or use the utility class "ReadCSV" in "jpgraph_utils.php".
<p>
A basic example on how to do this for a line graph assuming the name of the data file
is "data.csv".
<pre>
&lt;?php
include ("../jpgraph.php");
include ("../jpgraph_line.php");
include ("../jpgraph_utils.inc");

$n = ReadFileData::FromCSV(\'data.csv\',$datay);
if( $n == false ) {
    die("Can\'t read data.csv.");
}

// Setup the graph
$graph = new Graph(400,300);
$graph->title->Set(\'Reading CSV file with \'.$n.\' data points\');
$graph->SetScale("intlin");

$l1 = new LinePlot($datay);
$graph->Add($l1);

$graph->Stroke();
?&gt;
</pre>
'
),


array(
'How do I pass data from a Database (e.g. MySQL) to a script to produce a graph?',
'By adding some SQL statments in Your graph scripts that creates the
data arrays from the DB. <p>
Watch out for empty values and strings.
JpGraph doesn\'t know how to plot strings. Any value passed into JpGraph should be
only valid numeric data.
See the online discussions on populating from a DB Populating DB or the
discussion on how to read data from file Reading from file.
<p>
See <a href="http://jpgraph.intellit.nl/viewtopic.php?t=8">How to populate arrays from mySQL</a>'
),


array(
'I change my data but my image does not get updated? The old image
is still send back to the browser?',
'What you are seeing is a cached version of Your image. Depending on your
setup it could either be that the browser has a cached image or You are using
the builtin cache system in the library by accident.
<p>
<b>Fixing the browser cache</b><p>
Since the
script from the browser point of view is the same it just displays the old
image. To fix this you need to turn of the browser image caching.
<p>
Another "trick" that can be used since normally it is impossible to control
the browser for the end user is ot add a "dummy" URL argument which changes. This
way the brower will always see a new URL and then alwyas reload that file. This could
be done for example as:
<pre>
echo (\'&lt;img src="graphscript.php?\' .microtime(). \'"&gt;\');
</pre>
<p>
<b>Fixing the library cache</b><p>
The other reason might be that You have enabled the built-in cache feature in
JpGraph. To turn it of You can either
<ul>
<li>  Not specify a cache name in the call to Graph().
Just call new Graph(200,200) for example.
<li> Turn off the reading from the cache by setting READ_CACHE to false
(in jpg-config.inc)
<li>  Turn off the reading and writing from the cache by setting USE_CACHE to false (in jpg-config.php)
<li> Use the cache but with a timeout so that the image will be re-generated if
        the cached image is older then the specified timeout value in the call
        to Graph().
</ul>
 '
),

array(
'Can I run JpGraph in batch-mode just outputting an image directly
to a file and not streamed back to the browser? ',
'Yes. Just specify an absolute file name in the call to Graph::Stroke(). To store the image
in the local temp directory use:
<pre>
 $myGraph->Stroke("/tmp/myimage.png")
</pre>
<b>Note:</b> You must match the file ending Yourself to the format you have chosen to generate the
image in.
'
),

array(
'Is there a mailing list for JpGraph? ',
'No, but there is a user community forum at se link from JpGraph home page.'
),

array(
'Do you offer a commercial version of JpGraph with full support and no QPL?',
'Yes, For commercial (non-open-source) you will need to get the "JpGraph
      Professional License". This allows you you deploy JpGraph in a commercial
      context. Further details upon contact.'
),

array(
'Some of my script just return a blank image and no error messages? ',
'This could potentially be a lot of things depending on which browser
      you are using. One thing you might want to check is that your script
      doesn\'t take to long time. In that case they might hit the time limit for
      running a PHP script as specified in php.ini. You can adjust that
      time limit with a call to set_time_limit().<p> If You are seeing just an empty
page (really empty) then this is a sign that Your server has crashed. Most likely an
old version of PHP is being used which has taken down the HTTP server process. '
),

array(
'I can see the generated image fine in the browser but I can\'t print it? ',
'This is again browser dependent. Some browser does not like to print an
      image which is generated on-line and does exist as a *.jpg, *.png etc
      file. No good workaround has been identified short of changing browser.
Some browsers (and versions) can print others not.
The only real safe way (if you need printing) is to  generate the image on disk and then have the browser read the image from there. '
),

array(
' How can I generate an image directly to disk without streaming it back to the browser?',
' Two ways:

        (Preferred way) If you supply a filename in the call to $graph->Stroke()
        the image will be written to that file and not be streamed back to the
        browser.
        If you prefer to have the image going to the cache directory but not
        streamed back then you could just set the \'$aInlineFlag\' in the initial
        call to Graph() (fifth argument) to false as in
<pre>
        $mygraph = new Graph(200,200,"auto",0,false)
</pre>
        The "auto" argument makes an automatic file name in the cache based on
        the script name. The 0 indicates that we have no timeout. The advantage
        with this method is that you can specify a timeout to avoid having the
        image generated to often. '
),

array(
'When I try to plot graphs with many 1000:s of data points I only
      get a blank page. Is there a limit in JpGraph to the number of data points
      you can plot? ',
' No, there is no such limit. The problem is most likely that your script
      takes so long time that the PHP execution limit (as specified in php.ini)
      aborts the script. If you have more than 10,000 data points JpGraph will
      work but doing this kind of heavy data analysis on a WEB-server extension
      is probably not a good idea to start with.
<p>
The other reason could be that the script exhausts the allowed memory limit
for PHP as specified in the "php.ini" file. By default this is often set to
8Mb which is to low for a complex JpGraph script. Try increasing the memory
limit to a minimum of 16Mb. For very complex graphs with 1000s of data points
there might be a need to increase the memory even further.
 '
),

array(
'How can I use an image in a dynamically created PDF?',
'You can do this in two ways, you can either stroke the image created with the library
directly to a file where it can be used with Your PDF library of choice. For example,
using FPDF
(<a href="http://www.fpdf.org/">www.fpdf.org</a>) the Image() functoin would have
to be used to read an image from the filesystem.

<p>
If You are using the PDF library (APIs included in the PHP distribution but the library
itself might require a license depending on Your usage.)
you can avoid the storage of the file by getting the image handler for
the image directly and use it with PDF.
<p>
With the PDF library you must first open the in memory image with a call to
<i>pdf_open_memory_image($pdf, $im)</i>. The following script places an image from
JpGraph directly into a PDF page that is returned when running this script.
<pre>

&lt;?php

$graph = new Graph(...);

// Code to create the graph
// .........................
// .........................

// Put the image in a PDF page
$im = $graph->Stroke(_IMG_HANDLER);

$pdf = pdf_new();
pdf_open_file($pdf, \'\');

// Convert the GD image to somehing the
// PDFlibrary knows how to handle
$pimg = pdf_open_memory_image($pdf, $im);

pdf_begin_page($pdf, 595, 842);
pdf_add_outline($pdf, \'Page 1\');
pdf_place_image($pdf, $pimg, 0, 500, 1);
pdf_close_image($pdf, $pimg);
pdf_end_page($pdf);
pdf_close($pdf);

$buf = pdf_get_buffer($pdf);
$len = strlen($buf);

// Send PDF mime headers
header(\'Content-type: application/pdf\');
header("Content-Length: $len");
header("Content-Disposition: inline; filename=foo.pdf");

// Send the content of the PDF file
echo $buf;

// .. and clean up
pdf_delete($pdf);

?&gt;
</pre>

'
),


array(
'How can I force the user to get a question to download the generated image instead of
just displaying it in the browser? ',
'Change your code for creating the image:
<pre>
  ...
  $im=$graph->Stroke(_IMG_HANDLER);
  $filename="chart";
  $file_type = "image/png";
  $file_ending = "png";
  $filename=$filename.".".$file_ending;
  header("Content-Type: application/$file_type");
  header("Content-Disposition: attachment; filename=".$filename);
  header("Pragma: no-cache"); header("Expires: 0");
  ImagePNG($im);
</pre>
A html link, which directs to the php page (assuming the filename is chart.php):
Download  Then, if you click on the link, a download dialog appears and you can
download the "chart.png". <b>Note:</b> If you directly open chart.php, the
image is directly streamed to the browser and the download dialog will not open. '
),


array('How can I open up a CSIM link in a graph in a separate window?',
'
To open a target CSIM (drill down) in a separate window some
javascript in the target link is necessary since this action must be performed
in the browser.

The target URL needs top be in the form of an action to open up a window (with any optional
URL argument that might be needed). For example, assume we have a bar graph and
that theb user can click on each bar to get more details. When the user clicks on a
bar we open up the detaails witha call to the helper script
"bar_details.php" and send the parameter "id" to the script to separate the individual
bars. We would then use the following URL link (with javascript)
<pre>
"javascript:window.open(\'bar_details.php?id=%d\',\'_new\',
\'width=500,height=300\');void(0)"
</pre>
Where the \'%d\' placeholder must be replaced by the appropriate Id for each bar.
<br>
To assign the appropriate id we could use the following construct
<pre>
...
// Create targets for the image maps so that the details are opened
// in a separate window
$fmtStr = "javascript:window.open(\'bar_details.php?id=%d\',\'_new\',
\'width=500,height=300\');void(0)";

$n = count($datay);
$targ=array();
$alts=array();
for($i=0; $i < $n; ++$i) {
    $targ[$i] = sprintf($fmtStr,$i+1);
    $alts[$i] = \'val=%d\';
}

$bplot->SetCSIMTargets($targ,$alts);
$graph->Add($bplot);
...
// Send back the HTML page to browser
$graph->StrokeCSIM();

</pre>
It should be noted that in the above Javascript code we have used the special
window name \'_new\' which means that a new window will be opened each time a
user clicks on a bar. By giving the window a specific name the same window
would be re-used every time.
'),

/*
array(
'Q',
'A'
),
*/

)), /* GENERAL */


/* ******************************** */
array('Using TTF fonts and Texts',
/* ******************************** */

array(
array(
'No TTF fonts are displayed.',
'There are potentially many reasons for this Please start by trying the
following bare bones PHP script to see if basic TTF support is available
in the PHP setup.
<pre>
&lt;?php
// Change this defines to where Your fonts are stored
DEFINE("TTF_DIR","/usr/X11R6/lib/X11/fonts/truetype/");
// Change this define to a font file that You know that You have
DEFINE("TTF_FONTFILE","arial.ttf");
// Text to display
DEFINE("TTF_TEXT","Hello World!");

$im = imagecreatetruecolor (400, 100);
$white = imagecolorallocate ($im, 255, 255, 255);
$black = imagecolorallocate ($im, 0, 0, 0);

imagefilledrectangle($im,0,0,399,99,$white);
imagettftext ($im, 30, 0, 10, 40, $black, TTF_DIR.TTF_FONTFILE,TTF_TEXT);

header ("Content-type: image/png");
imagepng ($im);
?&gt;
</pre>
The above script when run should produce an image with a black text string
on a white background. If this doesn\'t work then there is a setup problem with
PHP + TTF.
<p>
As a first step to resolve this recompile Your PHP4 setup using the following basic
configuration (depending on the local conditions some options/path might have to be changed).
The critical options are marked in bold.
<pre>
./configure --prefix=/usr/share \
--datadir=/usr/share/php \
--with-apxs=/usr/sbin/apxs \
--libdir=/usr/share --includedir=/usr/include \
--bindir=/usr/bin \
--with-config-file-path=/etc \
--enable-mbstring --enable-mbregex \
--with-mysql  \
<b>--with-gd \
--enable-gd-imgstrttf \
--enable-gd-native-ttf \
--with-ttf-dir=/usr/lib \
--with-freetype-dir=/usr/lib \
--with-zlib-dir=/usr/lib \
--with-png-dir=/usr/lib \
--with-jpeg-dir=/usr/lib \</b>
--with-xpm-dir=/usr/X11R6 \
--with-tiff-dir=/usr/lib \
--enable-memory-limit --enable-safe-mode \
--bindir=/usr/bin \
--enable-bcmath -enable-calendar \
--enable-ctype --with-ftp \
--enable-magic-quotes \
--enable-inline-optimization \
--with-iconv
</pre>
If there is still no TTF fonts displayed then the enxt step is to upgrade Your TTF libraries
to the latest version. The FreeType version 2.1.9 is known to work well.
'
    ),
array(
    'All my TTF fonts are yellow no matter what color I specify?',
'You have a old buggy version of the FreeType library, most likely the old FreeType I library is being used.
Please upgrade to the latest version of FreeType II.'
    ),

array(
    'I get an error "This PHP build has not been configured with TTF support.
You need to recompile your PHP installation with FreeType support."',
'This error is reported if the built-in PHP/GD function
<a href="http://www.php.net/manual/en/function.imagettfbbox.php">"imagettfbbox()"</a>
is not available.
This is a crucial method to make TTF fonts work with JpGraph. The most likely reason for this problem
is that the PHP configuration is faulty and does not have correct support for TTF fonts. Please recompile
PHP as shown above and make sure that the built-in version of GD is being used and not the stand-alone
library.
'
    ),


array(
'I get an error "Fatal error: Font cant be found"',
'You have either not specified a correct path where your fonts are
      stored (see top of jpg-config.inc) or you have tried to use a font you do not
      have installed.'
),

array(
'I get the error "Can\'t find font file FONT_PATHarial.ttf" (or some
      other font)',
'You are most likely running on Windows. This seems to be caused by a bug in
      PHP/Apache (or PHP/IIS) specifically on Windows. The problem seems to be
      that PHP doesn\'t remember a DEFINE() setting across two or more include
      directive. A simple workaround is to hard-code the font path in class TTF
      in file jpgraph.php. Note: If you have this problem you will most likely
also have a problem  with the path to the cache directory.'
),


array(
    'I get an error "Font file ... is not readable or does not exist"',
'This error is caused by the inability of PHP/JpGraph to read the font file. This could have several
reasons:
<ol>
<li> The file path or name is wrong and the file really doesn\'t exist.
Please check that the file and path (as shown in the error message) really exists.
<li> If the file exists it might still not be possible for PHP to read the file due to
permission problem. Please make sure that PHP can read a file in the TTF directory.
This can be verified with the following short script
<pre>
&lt;?php
// Change this defines to where Your fonts are stored
DEFINE("TTF_DIR","/usr/X11R6/lib/X11/fonts/truetype/");
// Change this define to a font file that You know that You have
DEFINE("TTF_FONTFILE","arial.ttf");

$f = TTF_DIR.TTF_FONTFILE;
if( file_exists($f) === false || is_readable($f) === false ) {
    echo "<b>FAIL:</b> Can not read font file \"$f\".";
}
else {
    echo "<b>PASS:</b> Successfully read font file \"$f\".";
}
?&gt;
</pre>
If the script reports <b>FAIL</b> then it must be investigated whether the file names
or permissions are wrong.
</ol>
'
),


array(
'How can I install additional TTF font families? ',
'See the
<a href="phptip04.php">Adding additional TTF font families</a>
section on this site for a full explanation of the necessary steps.'),

array(
'How can I display special characters that isn\'t available on the keyboard?',
'By using the standard "&#dddd" encoding of the symbol in a text string.
For example to get the character for the the "copyright" symbol &copy; which has the numeric code
"00A9" (in Hex)
<pre>
$copy = sprintf(\'&#%04d;\',hexdec(\'00A9\'));
</pre>
In a similair way this can be used to show Greek letters, for example
"'.sprintf('&#%04d;',hexdec('03B2')).'" (beta)
is displayed by
<pre>
$beta = sprintf(\'&#%04d;\',hexdec(\'03B2\'));
</pre>
<b>Tip:</b> Use the class "SymChar" defined in jpgraph_utils.php to get easy access
to greek and special mathematical symbols. This class allow the specification of
common symbols by name. Some examples:
<pre>
// '.sprintf('&#%04d;',hexdec('03B4')).

' (delta)
$gamma = SymChar::Get(\'delta\');
// '.sprintf('&#%04d;',hexdec('03BC')).
' (mu)
$mu = SymChar::Get(\'mu\');
// '.sprintf('&#%04d;',hexdec('03C0')).
' (pi)
$pi = SymChar::Get(\'pi\');
// '.sprintf('&#%04d;',hexdec('03BB')).

' (lambda)
$lambda = SymChar::Get(\'lambda\');
// '.sprintf('&#%04d;',hexdec('222B')).

' (integral sign)
$integral = SymChar::Get(\'int\');
// '.sprintf('&#%04d;',hexdec('2248')).

' (approximation sign)
$approx = SymChar::Get(\'approx\');
</pre>
'

),

      array('When I put a text object on a graph and use Set90AndMargin() it doesn\'t show?',

'
The main casue for this behaviour is that the text object position is rotated 90 degrees.
<p>
For example, putting a text object at Pos(0,0) it will  become "invisible".
The reason for this behaviour is that the texts position (not the text itself) is
rotated around the center of the image 90 degrees clockwise.
<p>
For example, assuming the image is WxH in size.
Rotating position (0,0) which is the top left corner of the image gives the rotated position:
<br>&nbsp;<br>
<div align="center">
<tt><b>(0,0) => rotate 90 degrees => (W,0)</b></tt>
</div>
<br>
<p>
Now, if a string was put at position (W,0) it will be drawn outside the image
and hence become invisible.
<p>
If You need to position text with rotated images just keep this in mind and swap the
meaning of the X and Y posiiont since the X-position will become the Y position and vice
versa after a 90 degree rotation.
Some experiements will soon allow You to get the hang of it.
<p>
Tip: Start with an image that is equal in W and H since this makes it easier to understand the rotation.

'),

)),

/* TTF FONTS */


/* ******************************** */
array('Error Messages',
/* ******************************** */


array(

array(
'I get an error <font color="darkred">"Error: Cannot add header information - headers already sent ..."</font>',
'First, this is not a problem with JpGraph per se. What has happened is
      that your PHP file which produces the image has already returned some data
      to the browser before the image has been sent. This is most often caused
      by one or more spaces before the first "&lt;?php" The browser will now
      implicitly set the header to plain text.<p>
      When later JpGraph tries to send the correct image header the browser gets
      confused since it has already received a header for the current document.
      (Each document can only have one and only one type).
      Check your files for any output (even a single space) before the call to
      Graph::Graph() (or Graph::Stroke())<p>
      If you are running on Windows this problem could be caused by a blank line
      at the end of any of the jpgraph_*.php files. All files in jpgraph ends in
      a newline which some configurations on Windows doesn\'t like. Remove the
      newline so that the file ends just after the final "?&gt;"<p>
      Also remember that when you include external file using
      include/include_once and so on Php include the whole content of the file;
      this content of the file also include any potential carriage return/line
      feed or "blank" space before "&lt;?php" and after "?&gt;" These "dirty
      characters" will stop the JpGraph being properly sent back because they
      are included in the image streaming. '
),

array(
'I get an error <font color="darkred">"Unknown function imagecreate"</font>',
'You have not compiled PHP with support for the GD graphic library. See
      PHP documentation for details. Note that you also need to configure PHP to
      use GD and/or TTF fonts to get JpGraph full functionality'
),

array(
'I get an error <font color="darkred">"Unknown function imagecreatejpeg"</font>',
'You have not compiled PHP with support for the JPG format. See PHP
      documentation for details'
),

array(
'I get an error <font color="darkred">"Warning: MkDir failed (Permission denied) in jpgraph.php on line XXXX"</font>',
'This is a permission problem. To use the cache Apache/PHP must have
      write permission to the cache directory. Make sure that Apache/PHP have
      sufficient permissions to write to the specified cache directory.'
),

array(
'I get an error
<font color="darkred">"Fatal error: Undefined class name "parent" in jpgraph.php on line xxxx"</font>',
'You are using an older version of PHP. JpGraph requires at least PHP 4.3'
),

array(
    'I get an error <font color="darkred">"Your data contains non-numeric values."</font>',
'Most likely Your data really contains non-numeric data which You need to further
investigate (for example by printing out the array with a <i>var_dump()</i>.
One additional thing to watch out for is
if the data looks like ".56" (or "-.56") which is a shortform of "0.56". The problem
is that the number starts with an "." (dot) which is non-numeric.
The solution is to replace the single dot with a "0."'
    ),

array(
'I get an error <font color="darkred">"Date is outside specified scale range"</font>
trying to create a Gantt chart',
'As the error says, you start or end date for a activity is
      larger/smaller than the max/min value in the scale. If you get this error
      and you are using automatic scale then you are probably using a null value
      (empty string "") as start or end date. Check your data'
),


array(
'I get an error <font color="darkred">"Invalid file handle in jpgraph.php at line XXXX"</font>',
'This is a permission problem. Check that your cache directory has the
right permissions to let JpGraph access and write to it. '
),

array(
'I get an error <font color="darkred">"Fatal error: Call to undefined function: getcsimareas() ..."</font> ',
'You have enabled the DEFINE("JPG_DEBUG",true) in jpgraph.php. This is
an internal debug flag which should always be left untouched. '
),

array(
'I get an error <font color="darkred">"Fatal error: Call to undefined function: imagetypes()"</font>',
'You have not installed the core GD library correct. imagetypes() is a standard GD function. Please refer
to the installation section in the manual for more information on how to verify You setup.'
    ),

array(
' I get an  error saying something like <font color="darkred">"Error: \'parent::\' not valid in context..."</font>',
'You are most likely using the Zend cache.
There is a bug with some versions of the Zend cache together with the "parent" meta
class. If the referenced parent class is in another file that is included this problem seems to occur.
The workaround seems to be to put all classes in the same physical file or upgrade the Zend cache to
a more recent version.'
),

array(
    'I get an error <font color="darkred">"Image cannot be displayed because it contains errors.."</font>',
'First of all this is an error message from the browser and not the library.
There could be various reasons for this but the most
likely scenario is that Your installation of PHP has both enabled output buffering and enabled strict error checking.
<p>
What could now happen is that with output buffering enabled PHP will buffer up any text error messages.
This could for example be som "Notice:" warnings if You have forgotten to initialize some variables.
When then the library adds the proper image header and the buffered error messages together with the
image gets sent back the browser it all falls apart.
<p>
The browser tries to interpret both the error messages and the image data as an image and it of course fails
and gives this error message. Why? Because the textual error messages that was buffered is interpretated as
if they would belong to the image which of course is nonsense.
<p>
The solution is to disable output-buffering until You are convinced that Your code is without any problem.
On a develpment server it is recommended to always have output buffering disabled.
'
    ),


array(
'When I use PHP5 + JpGraph 2.x I get <font color="darkred">"A plot has an illegal scale..."</font>',
'There have been a few reports of this problem and it seems to be due to a
faulty PHP 5.x installation.
For example a standard SuSE 9.3 PHP5 installation gives this problem.
The exact reason for the problem has not been established
but it all points to a PHP5 problem since it can be solved by adjusting the PHP installation
without any change in the library.
<p>
<b>Step 1:</b>
First check that Your php.ini file have compatibility mode turned off
<pre>
zend.ze1_compatibility_mode=off
</pre>
<p>
<b>Step 2:</b>
If turning the compatibility mode off still doesn\'t solve the problem
the only remaining solution is to re-compile PHP 5.
For example on our development servers we use the following configuration
Note: We place "php.ini" in "/etc/php5/apache2" and You might want to change this
to suit Your specific setup.
<pre>
./configure --prefix=/usr/share --datadir=/usr/share/php \
--with-apxs2=/usr/sbin/apxs2-prefork \
--libdir=/usr/share --includedir=/usr/include \
--bindir=/usr/bin \
--with-config-file-path=/etc/php5/apache2 \
--enable-mbstring --enable-mbregex \
--with-mysql  \
--with-gd --enable-gd-imgstrttf --enable-gd-native-ttf \
--with-zlib-dir=/usr/lib \
--with-png-dir=/usr/lib --with-jpeg-dir=/usr/lib --with-xpm-dir=/usr/X11R6 \
--with-tiff-dir=/usr/lib --with-ttf-dir=/usr/lib \
--with-freetype-dir=/usr/lib \
--enable-ftp \
--enable-memory-limit --enable-safe-mode \
--bindir=/usr/bin \
--enable-bcmath -enable-calendar \
--enable-ctype --with-ftp \
--enable-magic-quotes \
--enable-inline-optimization \
--with-bz2 \
--with-iconv
</pre>

'),


)),

/* ******************************** */
array('Formatting Problems',
/* ******************************** */

      array(

array(
'I try to mix bar and line graphs and the bars doesn\'t get centered
      and the labels are not correctly aligned?',
'This is a known problem. The best way to partly solve this is to make
      sure you add the bar plot as the last plot to the graph. The reason behind
      this problem is that plot that gets added to the graph internally makes
      modification to the alignment of the plot. Since each plot does not know
      what other plot has been added it will happily overwrite previous plots
      settings in the graph. Hence the workaround by adding the bar last.
      conflicting settings.)'
),
array(
'How do I turn off anti-aliasing for TTF fonts?',
'There is not any built in support in JpGraph at the moment to do this.'
),

array(
'The auto-scaling algorithm chooses very tight limits around my
      Y-values. How do I get a more "space" between the end of the scale and the
      min/max values? ',
'Use the SetGrace() to specify some extra space (as percentage of the
      scale) between the min/max value and the limits of the scale. For example
      $graph->yscale->SetGrace(10) gives 10% extra space at the ends.'
),

array(
    'I want to use autoscaling to handle the maximum value but I always want the Y-axis to start at 0 regardless?',
'Use the SetAutoMin() method. For example as in
<pre>
...
$graph = new Graph(400,350);
$graph->SetScale("intlin");
$graph->yaxis->scale->SetAutoMin(0);
...
</pre>
<b>Hint:</b> If you need to limit the maximum value but auto-scale the minimum value use the SetAutoMax() method.
'
    ),

array('I want the position of the X-axis to be at the bottom of the Y-scale and not always at the position Y=0?',
      'To adjust the position of the Axis Use the Axis::SetPos() method. The argument to this method can be either the numerical scale value on the Y-axis where the X-axis should be positioned or it can be one of the two special value "min" or "max". In the latter case the axis will be positioned on either the minimum or the maximum value of the scale. For example
<pre>
...
$graph->xaxis->SetPos("min");
...
</pre>
Will put the X-axis at the lowest value of the Y-axis.<br>
<b>Note:</b> The same positioning is possible for the Y-axis.
'),

array(
'I specify color X in the image but the color displayed is not
      exactly what I specified?',
'This is a result of a finite color palette for GIF, PNG formats. If you
      are using anti-aliasing, perhaps a background image or even gradient fill
      you might exhaust the color palette supported in the GD library.
      Try set the constant USE_APPROX_COLORS to false and generate the picture
      again. If you now get an error message saying that no more colors can be
      allocated this is the problem. There is no good workaround if you are
      using GD 1.x since for PNG the GD 1.x library does not support
      "True-color".
<p>
      The only real solution is to upgrade to GD 2.x to get full true-color
      support. If you are using a background image try to "degrade" it to have a
      smaller color palette or turn of anti-aliasing and you might have enough
      free palette entries to cater for all the colors you want and still use GD
      1.x

'
),

array(
'Can I have labels at an arbitrary angle on the X-axis? ',
'Yes, almost any text can be stroked at an arbitrary angle.
For example to have the labels at 45
      degrees angle use
<pre>
...
$graph->xaxis->SetTickLabels($labels);
$graph->xaxis->SetLabelAngle(45);
...
</pre>
Note: Internal fonts support 0 and 90 degrees text. If you need to use,
      say 45 degree (or any other arbitrary angle), you must use TTF fonts. '
),

array(
'How do I invert the Y-scale so that it has the minimum value on top and the largest value at
the bottom?',
'The easiest way to do this is by following a two step process by first
a) Negating all Your values and then b) Create a callback function for the Y-axis that negates
all the display values.
<p>
What will happen now is that after the negative values have been feed into the graph it will
create a scale starting at the lowest value, say -8, then go up to the highest, say -1. If these
values are then inverted when printed it will in affect achieve the inverted axis appearance. The code
snippet below shows a basic example of this technique.
<pre>
...
// Callback to negate the argument
function _cb_negate($aVal) {
    return round(-$aVal);
}

// A fake depth curve
$ydata = ....

// Negate all data
$n = count($ydata);
for($i=0; $i<$n; ++$i) {
    $ydata[$i] = -$ydata[$i];
}

// Basic graph setup
$graph = new Graph(400,300);
$graph->SetScale("linlin");

// Setup axis
$graph->yaxis->SetLabelFormatCallback("_cb_negate");
$plot = new LinePlot($ydata,$xdata);
$graph->Add($plot);
$graph->Stroke();
</pre>
Two scripts that uses this technique can be found in the <tt>Examples/</tt> directory in the distribution, "inyaxisex1.php" and "inyaxisex2.php".

'),

array(
' Can I have the auto-scaling algorithm restrict itself to whole numbers?',
'Yes, use the "int" scale specification'
),

array(
'Is it possible to have horizontal bar graphs?',
' Yes, Just create a normal bar and call the method Set90AndMargin()
to rotate the graph.'
),

array(
'Line weight does not seem to work in my graphs? I specify a thick line but still get a
thin line?',
'You have probably enabled Anti-aliasing. If anti-aliasing is enabled
setting line-weight will have no affect.'
),

array(
'How can I have more space between the Y-axis and the title? ',
'Use the Axis::SetTitleMargin() method. For example to have a 25 pixels
margin for the Y-title you could use:
<pre>
...
$mygraph->yaxis->SetTitleMargin(25);
...
</pre>'
),


array(
' How can I display both X and Y values above each data point in a line, bar or scatter plot?',
'You need to use a value formatting callback. The callback function is called for
each data point and is passed the Y-value as argument. This means that if You also
need to display the x-value it must be available in the callback function,perhaps
as a global data array.
<p> Something along the lines of
<pre>
...
$datay = array(...);
$datax = array(...);
$idx=0;
function xyCallback($yval) {
  global $datax, $idx;
  return \'(\'.$datax[$idx++].", $yval)";
}
...
$graph = new Graph(...);
$graph->SetScale("intlin");
$p1 = new LinePlot($datay,$datax);
$p1->value->SetFormatCallback(\'xyCallback\');
$p1->value->Show();
...
$graph->Stroke();
</pre>
'
),


array(
'Can I display stock box-charts (open, close, high, low) with
JpGraph? ',
'Yes, just create a  StockPlot() graph.'
),


array(
'Is there any way to specify a newline in the legend box for a specific legend?',
'Yes. From version 1.8 full multi-line text paragraphs are supported. Just make
sure that your text uses double-quotes and a newline character.
'
),


array(
'How can I print unicode characters?',
'Use &amp;#XXXX; format in your strings where XXXX is the decimal value for
the unicode character. You may find a list of Unicode characters and there
encodings at
<a href="http://www.unicode.org/charts/">www.unicode.org</a> Please observe
that the encoding in the lists are given in hexadecimal and these values must be converted
to decimal.
<p>
Note: If You are working in an UTF-8 environment then the characters may be
input directly.'
),


array(
'My background images doesn\'t display properly. It just shows a black solid square? ',
'You are using a very old GD version (probably 2.0.1).
Background images only work with
a truecolor image, (enable the USE_TRUECOLOR constant). Some people
      have reported that it works as long as the background image is not in PNG
      format. The drawback with truecolor images
      is that truefont doesn\'t work properly in GD versions < 2.0.8
'
),


array(
' How do I make each bar in a bar plot have it\'s own color?',
'Specify an array as argument to BarPlot::SetColor() as in
<pre>
  ...
  $mybarplot->SetColor(array("red","green","blue","gray"));
  ...
</pre>
'
),


array(
'How can I adjust the position of the axis title?',
'You can add an alignment parameter when you specify the title. You
      specify one of "high", "low" or "center" as in
<pre>
$mygraph->xaxis->SetTitle("mytitle","high");
$mygraph->xaxis->SetTitle("mytitle","center");
$mygraph->xaxis->SetTitle("mytitle","low");
</pre>'
),


array(
'How can I change the image format, i.e jpeg, gif or png? ',
'Use the Image::SetImgFormat() method at runtime. You can also change
      the default value with the DEFAULT_GFORMAT define in jpg-config.php. This is
      normally set to \'auto\' format which means that JpGraph will automatically
      choose the format depending on what is available.
<p>For example to use the JPEG format :
<pre>
$graph->img->SetImgFormat(\'jpeg\');
</pre>'
),


array(
'How do I specify the font for legends?',
'Use the Legend::SetFont() method. As in
<pre>
$graph->legend->SetFont(FF_FONT1,FS_BOLD);
</pre>
'
),


array(
'When I rotate text and labels the text is not rotated correctly?',
'Red Hat 7.2 has a bug in it\'s TTF libraries FreeType 2.0.3 that comes
      with 7.2. Upgrade to FreeType 2.0.9. Read more about this problem <a href="">here (on
      Google groups)</a> '
),


array(
'When I rotate a paragraph (multi-line) text the paragraph is
      always left aligned even though I have specified another alignment. It
      seems fine for non-rotated paragraphs though. What is the problem? ',
'This is a limitation with the current implementation. (The reason is
      that GD does not support inter-paragraph alignment so all that logic is
      done within the libraries string-layout engine.
<p>
At the moment the logic only implements this
      paragraph alignment for non-rotated paragraphs.) For rotated paragraphs
      left-alignment will always be used regardless of specified paragraph
      alignment.'
),


array(
'I have a huge number of data points and I only want labels (which I want to specify as text string) and ticks on every x:th data. Can I do this?',
'Yes. What most users stumble on is the fact that the label array must still contain data
for all the data points even though only every x:th data label is displayed.<p> This means that
if your original data array only contains just the display values it is necessary first to
augment the label array with padding spaces to fill it out.
<p>
It is then possible to use the method Axis::SetTextTickInterval() to specify that only every n:th tick+label should be displyed. Something like:
<pre>
...
// Setup the X-axis
$graph-&gt;xaxis-&gt;SetTickLabels($datax);
$graph-&gt;xaxis-&gt;SetTextTickInterval( ... );
...
</pre>
'
),


array(
'How can I make the labels have 1000 comma separator?',
'The easiest way is to use the PHP built-in function "number_format()" as a
callback. <p>For example, to have the line plot display values using this format
install the callback as:
<pre>
...
$lineplot-&gt;value-&gt;SetFormatCallback("number_format");
...
</pre>
<p>
If you instead want the Y-axis label to use this kind of formatting install the callback using
<pre>
...
$graph-&gt;yaxis-&gt;SetLabelFormatCallback("number_format");
...
</pre>

'
),

array(
    'The Y2 axis is no longer positioned at the right side of the graph',
'This will happen after that You have manually specified the sclae and/or the tick
spacing. If the user manipulates
the default scale the library defaults to setting the position of the Y2 axis to the 0 X-position.
It is easy to re-adjust the Y2 axis position by calling SetPos() as the following code
snippet demonstrates
<pre>
$graph->y2axis->SetPos(\'max\');
$graph->y2axis->SetTitleSide(\'right\');
</pre>
'
    ),

array(
'How can I include several graphs in the same image?',
'This can be solved by a bit of extra GD code since the library by default do not directly support this functionality. The easiest way to solve this is to manually create a big enough empty graph with plain GD commands. Then get the image handles from the Stroke() methods in the graphs that should be included. It is then possible to use these handles together with the GD copy command and copy the individual graphs to the previously created empty large GD image. <p>
This is illustrated in the follwing code snippet. In the example below we assume that graph1 is the same size as the final combined graph we would like to create. This way our combined graph get a background and color as specified in the first graph.
<pre>
// Assume we would like to combine graph1,2 and 3
// ...... create graph 1 here.......
$handle1 =  $graph1->Stroke( _IMG_HANDLER);

// ...... create graph 2 here.......
$handle2 =  $graph2->Stroke( _IMG_HANDLER);

// ...... create graph 3 here.......
$handle3 =  $graph3->Stroke( _IMG_HANDLER);


// Now create the "melting graph" which should contain all three graphs
// $WIDTH1 and $HEIGHT1 are width and height of graph 1 ($handle1)
// $WIDTH2 and $HEIGHT2 are width and height of graph 2 ($handle2)
// $WIDTH3 and $HEIGHT3 are width and height of graph 3 ($handle3)
// $x2,$x3 and $y2,$y3 shift from top left of global graph (ie position of
// graph2 and graph3 in global graph)

$image = imagecreatetruecolor($WIDTH1,$HEIGHT1);
imagecopy($image, $handle1,0, 0, 0, 0, $WIDTH1,$HEIGHT1);
imagecopy($image, $handle1,$x1,$y1,0,0,$WIDTH2,$HEIGHT2);
imagecopy($image, $handle1,$x2,$y2,0,0,$WIDTH3,$HEIGHT3);

// Stream the result back as a PNG image
header("Content-type: image/png");
imagepng ($image);
</pre>
'),


)), /* FORMATTING */

/* ******************************** */
array('Specific 2D/3D Pie formatting',
/* ******************************** */

      array(
array(
'How can I have an exploded slice with 3D pie plots?',
'Use either Pi3DPLot::ExplodeSlice() or Pie3DPlot::Explode()
'
),

array(
' How can I display values for each slice close to the pie?',
'Use the method PiePlot::value::Show()'
),


array(
'How can I change between percentage and absolute values for pie slices? ',
' Use PiePlot::SetValueType($aType) where $aType is either PIE_VALUE_ABS
      or PIE_VALUE_PERCENTAGE. To hide/show values on the pie you access the
      value property of the plot (just like in line plots) If you want some
      special format of the string you also need to specify a format string. By
      default just a number gets printed. If you (for example) want percent with
      a "%" sign you should use a format string like "%d%%" (assuming you just
      want to display whole numbers)
<pre>
  ...
  $mypieplot-&gt;value->SetFormat("%d%%");
  $mypieplot-&gt;value->Show(); // Defaults to TRUE
  $mypieplot-&gt;SetValueType(PIE_VALUE_PERCENTAGE);
  ...
</pre>
'
),


array(
'Can I display the actual value as labels on the pie bar instead of
the percentage?',
'Yes, use
<pre>
...
$pieplot-&gt;SetLabelType(PIE_LABEL_ABS);
...
</pre>
and make sure labels are not hidden.
'
),

array(
'How can I adust the start angle of the first slice?',
'Use
<pre>
...
$pieplot-&gt;SetStartAngle(45);
...
</pre>'
),


)), /* 2S/3D Pie */

/* ******************************** */
array('MS Windows specific issues',
/* ******************************** */
array(
array('When I use IE v5 or v6 I can only save the generated graph image in the
browser as a BMP file even if it was generated as a JPEG or PNG encoded image?',
'This is a bug in the way IE handles HTTP headers. By default the library sends no-cache
headers to instruct the browser to always make a HTTP request to the server. This
is necessary since graph scripts normally have the same name but the graphs may change
over time and we don\'t want the browser to be fooled by thinking it has already fetched
the graph before.<p>
The only known workaround is to tell the library not to send back any no-cache headers
as illustrated below.
<pre>
...
$graph->img->SetExpired(false);
$graph->Stroke();
</pre>
The "SetExpired(false)" call instructs the library to not send back any has-expired headers.')
) )
);



$n = count($faqs);

for( $i=0; $i<$n; ++$i ) {

    echo "<qandaset>\n";

    echo "<title>";
    echo $faqs[$i][0];
    echo "</title>\n";

    $nn = count($faqs[$i][1]);
    $f = $faqs[$i][1];
    for(  $j=0; $j<$nn; ++$j ) {

        echo "<qandaentry>\n";

        echo "<question><para>\n";
        echo $f[$j][0];
        echo "</para></question>\n";

        $tmp = str_replace('<pre>','<programlisting>',$f[$j][1]);
        $tmp = str_replace('</pre>','</programlisting>',$tmp);
        $tmp = str_replace('<p>','<para>',$tmp);
        echo "<answer><para>\n";
        echo $tmp;
        echo "</para></answer>\n";
        echo "</qandaentry>\n";

    }

    echo "</qandaset>\n";
}

?>
