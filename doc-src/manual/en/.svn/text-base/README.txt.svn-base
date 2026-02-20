README
$Id$

General
-------
This directory contains the JpGraph manual which is written in XML using the
DocBook5 schema. This is then processed to produce either a HTML version or 
a PDF version of the manual.

The build process is automated and uses Phing as the "make" tool. Those not 
familiar with Phing might find some comfort in that this tool is PHP version 
of the Java Ant build system although they are not the same.

This was chosen over a traditional 'make' file since the build specification 
is much more readable and suited for this type of work. The fact that it is 
an extendable framework makes it very suitable for this type of automation
and automatic file manipulations.

To build the HTML manual
------------------------
This is the default build target in the build.xml script and assuming you have 
an installed and working Phing one only has to write

$>phing

to produce the manual as a single large HTML file and stored in output/html. 
In order to produce the chunked version one has to build the chunkhtml target, 
i.e.

$>phing chunkhtml

The resulted chunked HTML can be found at output/chunkhtml

In order to build the PDF version of the manual this is done by ubilding the 
pdf targets, i.e.

$>phing pdf

The resulting manual is stored in the file

output/pdf


Notes on DocBook PDF production
-------------------------------
In order to get the PDF bookmark to work there are two things that should
be observed.

1. In order to enable bookmarks the parameter fop1.extensions must be set to 1
in the xsltproc first step, for example
xsltproc  \
    --output myfile.fo  
    --stringparam fop1.extensions 1  \
    docbook-xsl/fo/docbook.xsl  \
    myfile.xml

2. In order to avoid the SEVERE warning on hyphenation that couldn't be found
the hyphenation package from
http://offo.sourceforge.net/hyphenation/index.html should be downloaded and
installed in the lib directory of the fop installation, 
usually /usr/share/fop/lib 

3. In order to use the phphl (PHP Highlighter) script it is necessary to install the PEAR
package Text_Highlighter. You should also note that this package is not compatible with
PHP5 running instrict mode. In order to make this work you must patch the source yourself
or turn off E_STRICT. The modified sources is available upon request.



