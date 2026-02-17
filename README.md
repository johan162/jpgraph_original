# JpGraph — Historic Archive

> **⚠️ This repository is a historic archive.** JpGraph was originally developed between ca 1998–2010 for **PHP 5.x** and the **GD 2.x** graphics library. This last version from the original author of JpGraph is not maintained, will not run on modern PHP versions, and is published here solely for historical and educational interest.

## What Was/Is JpGraph?

JpGraph is an object-oriented PHP graph-plotting library created by **Johan Persson** [owner of the now defunct Aditus Consulting]). Development started around 1998–1999 and continued through the end of the 2010:ish.

At its peak, JpGraph was the most comprehensive server-side charting libraries available for PHP and was for a decade the most used graphic library for PHP. It could produce publication-quality charts rendered as PNG, JPEG, or GIF images — all driven by PHP's GD extension with no JavaScript, no browser dependency, and no external rendering engine.

The library was eventually released under a **dual license**: the QPL 1.0 for open-source and educational use, and a commercial JpGraph Professional License. The reason for the dual license to be able to part tinme work almost fulltime with support and development.

## What happened to JpGraph?

I had a co-operation with the Japanese company Asial which re-distributed the library for Japanese customer and give basic support in Japanese. When I for various reason decided to walk away from the library I spent over a decade building and supporting I gave the library to Asial to maintain, enhance and continue supporting. Asial (https://jpgraph.net/) have continued to add support for newer version of PHP and the GD library. The current release supports PHP 8.5. 

I have no longer any interest in JpGraph or PHP and is more like a parent who has seen the kid grow up and move away from home. 


### What This Repository Contains

This repository collects the **last Pro release** (v3.1.6p, January 2010) together with some archival materials spanning the project's full lifetime. The original website is not included as it was dynamically generated with a home made PHP publishing system that is not compatible with modern PHP.

| Path | Description |
|------|-------------|
| [`jpgraph-3.1.6p/`](jpgraph-3.1.6p/) | Final professional release — source, examples, and rendered documentation |
| [`ddda/`](ddda/) | DDDA (Database Driven Documentation Architecture) — the custom tool built to document JpGraph's class hierarchy (see [README-DDDA.md](README-DDDA.md)) |
| [`doc-xml/`](doc-xml/) | DocBook XML source for the user manual and reference guide |
| [`QR-paper/`](QR-paper/) | A note on errors discovered in the official QR barcode specification during development of the QR module |
| [`barcode_architecture.md`](barcode_architecture.md) | Detailed technical description of all four barcode subsystems — PDF417, QR Code, Data Matrix, and 1D linear barcodes |
| [`misc/`](misc/) | Miscellaneous historical artifacts including the very first release (v1.0) |
| [`release-email-3.0.0.txt`](release-email-3.0.0.txt) | The original release announcement email for v3.0.0 |

---

## Project Layout in Detail

### `jpgraph-3.1.6p/` — The Library (v3.1.6p)

This is the final snapshot of the Professional edition, build r1928p, exported January 12, 2010. Back then SVN was used to manage the source code. 

#### `jpgraph-3.1.6p/src/` — Source Code

The core library and all plotting modules:

| File | Purpose |
|------|---------|
| `jpgraph.php` | **Core module** (~5 400 lines). The `Graph` class, `LinearScale`, `LogScale`, `LinearTicks`, `Axis`, `Plot` (abstract base), `DisplayValue`, `DateLocale`, `Footer`, `ColorFactory`, auto-scaling, image caching, and CSIM (client-side image map) support. |
| `gd_image.inc.php` | Low-level GD abstraction layer. The `Image` and `RotImage` classes wrap all GD2 calls — drawing primitives, color management, anti-aliasing, alpha blending, TTF text rendering, and image streaming. |
| `jpgraph_rgb.inc.php` | The `RGB` class with a lookup table of 500+ named colors (X11/CSS color names) mapped to RGB triplets. |
| `jpgraph_ttf.inc.php` | TrueType font management — maps logical font family/style constants to filesystem TTF paths. |
| `jpgraph_text.inc.php` | The `Text` class for arbitrary positioned, rotated, boxed text objects with word wrap. |
| `jpgraph_legend.inc.php` | The `Legend` class — layout engine for color-keyed graph legends. |
| `jpgraph_gradient.php` | `Gradient` class — 11 gradient fill styles (vertical, horizontal, radial, diagonal, etc.). |
| `jpgraph_errhandler.inc.php` | Exception-based error handling with localized messages. Can render error messages as images so broken charts show diagnostics instead of blank pages. |
| `jpg-config.inc.php` | Library configuration — cache directories, TTF paths, image format defaults, error locale. |
| `jpgraph_colormap.inc.php` | `ColorMap` class — 22 predefined colormaps (heat, rainbow, diverging, sequential) for matrix/contour plots. |
| `jpgraph_plotmark.inc.php` | Plot markers — squares, circles, triangles, diamonds, stars, crosses, image-based marks. |
| `jpgraph_plotband.php` | `PlotBand` and `RectPattern` classes — colored/hatched horizontal and vertical bands. |
| `jpgraph_plotline.php` | `PlotLine` — reference lines (horizontal/vertical) overlaid on graphs. |
| `jpgraph_utils.inc.php` | Utility functions — `ReadFileData`, `DateScaleUtils`. |
| `jpgraph_glayout_vh.inc.php` | Layout classes for horizontal/vertical graph composition. |

**Plotting modules** (each adds a chart type by extending the `Plot` base class):

| File | Chart Type |
|------|-----------|
| `jpgraph_line.php` | Line plots — filled, stepped, centered, gradient-filled areas. |
| `jpgraph_bar.php` | Bar charts — vertical, horizontal, grouped, accumulated, gradient/pattern fills, shadows. |
| `jpgraph_scatter.php` | Scatter plots, impulse (stem) plots, and vector field plots. |
| `jpgraph_error.php` | Error bar plots (min/max whiskers). |
| `jpgraph_pie.php` | 2D pie charts — exploding slices, guide lines, value labels, themes (earth, pastel, water, sand). |
| `jpgraph_pie3d.php` | 3D perspective pie charts. |
| `jpgraph_gantt.php` | Gantt project scheduling charts (~3 950 lines) — bars, milestones, constraints, multi-scale headers (hours → years), CSIM interactivity. |
| `jpgraph_radar.php` | Radar (spider/web) charts with linear and logarithmic scales. |
| `jpgraph_polar.php` | Polar coordinate plots (full 360° and 180° modes) with logarithmic scale support. |
| `jpgraph_windrose.php` | Wind rose diagrams — compass-directional frequency plots (4/8/16 directions). |
| `jpgraph_stock.php` | Stock/candlestick charts (open-high-low-close). |
| `jpgraph_contour.php` | **Contour (isobar) line plots** — a novel marching-edges algorithm (see [architecture-overview.md](architecture-overview.md)). |
| `jpgraph_contourf.php` | **Filled contour plots** — adaptive recursive subdivision (rectangular or triangular mesh) with label placement and collision avoidance. |
| `jpgraph_matrix.php` | Matrix/heatmap visualization with configurable colormaps and mesh interpolation. |
| `jpgraph_meshinterpolate.inc.php` | Recursive bilinear mesh interpolation — upscales coarse data matrices for smoother contour/matrix renders. |
| `jpgraph_odo.php` | Odometer/gauge plots — full and half-circle dials with multiple needle styles. |
| `jpgraph_led.php` | LED-style 7×4 dot-matrix digit/character rendering in 16 color schemes. |
| `jpgraph_canvas.php` | Canvas graph — a blank drawing surface for custom artwork. |
| `jpgraph_canvtools.php` | Canvas helper classes — `CanvasScale`, `Shape`, `CanvasRectangleText` for architectural diagrams. |
| `jpgraph_mgraph.php` | `MGraph` — multi-graph compositor that tiles several independent charts into one image. |
| `jpgraph_iconplot.php` | `IconPlot` — embed PNG/JPEG/GIF icons into any chart. |
| `jpgraph_imgtrans.php` | `ImgTrans` — post-rendering 3D perspective skew transformation. |
| `jpgraph_date.php` | `DateScale` — date/time-aware axis with automatic tick granularity (seconds → years). |
| `jpgraph_log.php` | Logarithmic scale and ticks. |
| `jpgraph_regstat.php` | Regression and statistics — `Spline` (natural cubic), `BezierSpline`, `LinearRegression`. |
| `jpgraph_antispam.php` | CAPTCHA image generator using hand-drawn digit images (base64-encoded JPEG). |
| `jpgraph_flags.php` | World flag images — 200+ countries in four sizes, embeddable as background or plot markers. |
| `jpgraph_gb2312.php` | GB2312 Chinese character encoding support. |
| `jpgraph_table.php` | `GTextTable` — graphical table rendering within charts. |

**Barcode and 2D code modules:**

| Directory | Code Type |
|-----------|----------|
| `barcode/` | 1D linear barcodes — UPC-A/E, EAN-8/13/128, Code 39/93/128, POSTNET, CODABAR, Interleaved 2-of-5, Code 11. |
| `QR/` | QR Code generator — full encoder, Reed-Solomon error correction, data masking, layout engine. |
| `datamatrix/` | Data Matrix (ECC 140 & ECC 200) 2D barcode generator with multiple encodation schemes. |
| `pdf417/` | PDF417 2D barcode generator with cluster patterns and data compression. |

See [barcode_architecture.md](barcode_architecture.md) for a comprehensive technical description of all barcode implementations.

**Other source directories:**

| Directory | Purpose |
|-----------|---------|
| `lang/` | Localized error messages — English (`en.inc.php`), German (`de.inc.php`), and a production variant that hides internal details. |
| `Examples/` | 400+ runnable example scripts demonstrating every chart type and feature. |
| `contourf_examples/` | Dedicated filled contour plot examples. |
| `matrix_examples/` | Matrix/heatmap examples. |
| `windrose_examples/` | Wind rose examples. |
| `odometer_examples/` | Odometer/gauge examples. |
| `table_examples/` | Graphical table examples. |

#### `jpgraph-3.1.6p/src-phpexpress/` and `src-stripped/`

Pre-processed versions of the library for production deployment:
- **`src-phpexpress/`** — Encoded with the NuSphere PHPExpress encoder. When used with the (free) PHPExpress PHP module, this skips parsing and compiles to bytecode, yielding ~50% faster execution.
- **`src-stripped/`** — Source with all comments and whitespace removed for faster PHP parsing on servers without an opcode cache.

#### `jpgraph-3.1.6p/docportal/`

The rendered documentation portal:
- `index.html` / `index_std.html` — Documentation portal entry pages.
- `manual.pdf` — The complete manual as a single PDF.
- `chunkhtml/` — The user manual rendered as chunked HTML (200+ pages), built from DocBook XML via Phing. Covers installation, every chart type, theming, caching, CSIM image maps, and all configuration options.
- `classref/` — The generated API class reference (HTML files for 90+ classes), produced by the DDDA system.

---

### `ddda/` — Database Driven Documentation Architecture

A custom web-based tool that Johan Persson built to manage JpGraph's API documentation. It parses PHP source code, stores the class hierarchy in a MySQL database, provides a web UI to edit descriptions per method/parameter, tracks documentation coverage as a percentage, and generates the HTML class reference shipped with the library.

See [README-DDDA.md](README-DDDA.md) for a detailed description.

| Path | Contents |
|------|----------|
| `ddda-1.4/src/` | The DDDA application — PHP parser, MySQL schema, web editor UI, HTML doc generator. |
| `ddda-1.4/docs/html/` | Generated documentation output. |
| `ddda-paper/` | A short paper/presentation describing the DDDA concept and architecture. |

---

### `doc-xml/` — Documentation Source (DocBook XML)

The original XML (using Docbook 5 schema) source for the JpGraph user manual and reference guide, authored in **DocBook** format and built using **Phing** (a PHP build tool). 

The documentation build system is a bit involved as it dynamically generates all almost 200 images (and includes the source) and in some sense works as a unit and regression test of each release as each figure should work as described in the documentation. The whole build system is driven by a custom medium complex Phing build recepie. I don't know how widely Phing is used today but it works quite well (its basically a PHP re-implementation of Java's Ant)

The documentation covers:

- Installation and configuration
- Tutorials for every chart type (line, bar, pie, Gantt, radar, polar, windrose, contour, matrix, odometer, stock, etc.)
- Barcode and 2D code chapters (QR, Data Matrix, PDF417, linear barcodes)
- Graphical tables
- Appendices (FAQ, named color reference, country flags, error message catalog)
- Chapter XML files, images, CSS stylesheets, and Phing build extensions

---

### `QR-paper/` — A Note on Errors in the QR Standard

During the development of the QR Code module, Johan Persson discovered minor errors in the official QR barcode specification (ISO/IEC 18004). The paper documents these discrepancies:

- `J. Persson - A note on minor errors in the QR standard.pdf` — The published note.
- `qrlog.txt` — Debug log output from the QR encoder used while verifying the issues.

---

### `misc/` — Historical Artifacts

| File | Description |
|------|-------------|
| `jpgraph10.zip` | **The very first public release of JpGraph (v1.0)**. An archive of the original library from circa 2000. |
| `jpgarch.php` | A JpGraph script (using `CanvasGraph` and `CanvasRectangleText`) that draws a visual architecture overview diagram of JpGraph's own internal structure — a chart made with the charting library about the charting library. |
| `gencolorchart.php` | A utility that generates visual color swatch charts for all 500+ named colors supported by JpGraph. |
| `flag_raw.bz2` | Raw country flag image data. |
| `jpgraph_forum_dump.sql.gz` | A MySQL dump of the JpGraph community support forum. |

---

### `release-email-3.0.0.txt`

The original announcement email for the JpGraph 3.0.0 Professional release, sent to existing license holders. Documents the major new features introduced in 3.0: matrix visualization, 2D contour graphs, QR codes, a command-line barcode utility, rewritten error handling with PHP5 exceptions, Gantt bars with discontinuities, and PHP 5.3 support.

---

## Requirements (Historical)

These are the original requirements — provided for historical context only:

- **PHP** 5.1.0+ (recommended 5.2+)
- **GD Library** 2.0.28+ (the PHP built-in GD was recommended)
- A web server with PHP support (Apache was typical)
- TrueType fonts for TTF-based text rendering
- MySQL (for the DDDA documentation tool only)

## License

The library was released under a dual-license model:
- **QPL 1.0** (Q Public License) for open-source and educational use
- **JpGraph Professional License** for commercial use

Copyright © 1998–2010 Aditus Consulting. All rights reserved.

---

*This archive was assembled by Johan Persson, the original author of JpGraph, as a historic record of the project.*
