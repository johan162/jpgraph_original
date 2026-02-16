# DDDA — Database Driven Documentation Architecture

> **⚠️ Historic artifact.** DDDA was built for PHP 4/5 with MySQL. It is not maintained and will not run on modern systems. It is included here as part of the JpGraph historic archive.

## Overview

DDDA (Database Driven Documentation Architecture) is a web-based documentation system designed and built by Johan Persson to manage API reference documentation for the JpGraph library. It was first publicly released in July 2002 (v1.2) with the last update in August 2003 (v1.4).

The core idea behind DDDA was a deliberate **separation of documentation from source code**. Unlike tools such as Doxygen or PHPDoc that embed user-facing documentation as comments in the source, DDDA takes a different approach:

1. **Parse** — Automatically scan PHP source files and extract the class hierarchy, method signatures, argument lists, instance variables, and inheritance relationships.
2. **Store** — Record everything in a relational MySQL database.
3. **Augment** — Use a web-based UI to add human-written descriptions, examples, cross-references, and return value documentation — all stored in the database, not in the source code.
4. **Generate** — Produce formatted HTML class reference documentation from the database via pluggable formatter classes.

This approach had several advantages for a solo developer managing a large library:

- **Source code stays clean.** No `@param` blocks or lengthy docblocks cluttering the code.
- **Documentation survives refactoring.** When a method signature changes, re-parsing updates the database while preserving existing descriptions.
- **Coverage tracking.** DDDA calculates a weighted documentation completeness percentage for every class and method, making it easy to direct effort to under-documented areas.
- **Incremental updates.** The parser only re-scans files whose modification time has changed since the last parse.

The generated output from DDDA can be seen in `jpgraph-3.1.6p/docportal/classref/` — the HTML class reference for 90+ JpGraph classes.

## Architecture

DDDA consists of three subsystems:

```
┌─────────────────────────────────────────────────────────────┐
│                    PHP Source Files                          │
└──────────────────────────┬──────────────────────────────────┘
                           │
                     ┌─────▼─────┐
                     │  Parser   │  jplintphp.php
                     │ Subsystem │  (regex-based PHP parser)
                     └─────┬─────┘
                           │
                    ┌──────▼───────┐
                    │   MySQL DB   │  dbschema_ddda.php
                    │  (per-project│  de_utils.php
                    │   tables)    │
                    └──────┬───────┘
                           │
              ┌────────────┼─────────────┐
              │            │             │
       ┌──────▼─────┐ ┌───▼────┐  ┌─────▼──────┐
       │  Web-based  │ │ Stats  │  │  Report    │
       │  Editor UI  │ │ Engine │  │  Generator │
       │ jpdocedit   │ │DocStat │  │jpgenhtmldoc│
       └─────────────┘ └────────┘  └────────────┘
```

### 1. Parser Subsystem

**Files:** `jplintphp.php`, `jpgendb.php`

The parser reads PHP source files line-by-line using regular expressions to extract:

- **Class definitions** — name, parent class (inheritance), file location, line number
- **Method signatures** — name, argument names and default values, line number
- **Instance variables** — name, default value, visibility

Key classes:
- `Parser` — The core regex-based PHP parser. Handles brace counting, string/comment skipping, and extracts structural information. Uses factory methods (`NewClassProp`, `NewFuncProp`) so subclasses can substitute specialized property objects.
- `ClassProp` / `FuncProp` — Value objects holding parsed class/method metadata.
- `LintDriver` — A simple driver that runs the parser for static analysis output.
- `DBParser` / `DBClassProp` / `DBFuncProp` (in `jpgendb.php`) — Extend the parser framework with database persistence. Override factory methods to create DB-aware property objects. The `Externalize()` method writes parsed data to MySQL, while `UpdateFromExisting()` intelligently merges new parse results with existing database records — preserving hand-written documentation even when method signatures change.

The parser also performs basic **static analysis**, warning about:
- Unused instance variables
- Missing `$this->` qualifiers
- Methods that shadow parent class methods

### 2. Database Schema

**Files:** `de_utils.php` (schema definitions), `dbschema_ddda.php` (visual schema generator), `jpdb.php` (MySQL wrapper)

For each project, DDDA creates three tables (suffixed with the project name):

#### `tbl_class_{project}`
| Column | Description |
|--------|-------------|
| `fld_key` | Primary key |
| `fld_name` | Class name |
| `fld_public` | Visibility flag |
| `fld_parentname` | Parent class name (inheritance) |
| `fld_file` | Source file path |
| `fld_linenbr` | Line number in source |
| `fld_numfuncs` | Number of methods |
| `fld_desc` | Human-written description |
| `fld_ref1` – `fld_ref4` | "See also" cross-references to other classes |
| `fld_timestamp` | Last modification time |

#### `tbl_method_{project}`
| Column | Description |
|--------|-------------|
| `fld_key` | Primary key |
| `fld_name` | Method name |
| `fld_public` | Visibility flag |
| `fld_classidx` | Foreign key to parent class |
| `fld_classname` | Parent class name (denormalized) |
| `fld_shortdesc` | One-line summary |
| `fld_desc` | Full description |
| `fld_return` | Return value documentation |
| `fld_example` | Example code |
| `fld_methref1` – `fld_methref5` | Cross-references to other methods |
| `fld_numargs` | Argument count |
| `fld_arg1` – `fld_arg10` | Argument names |
| `fld_argdes1` – `fld_argdes10` | Argument descriptions |
| `fld_argval1` – `fld_argval10` | Default values |
| `fld_timestamp` | Last modification time |

#### `tbl_classvars_{project}`
| Column | Description |
|--------|-------------|
| `fld_key` | Primary key |
| `fld_name` | Variable name |
| `fld_public` | Visibility flag |
| `fld_default` | Default value |
| `fld_desc` | Description |
| `fld_classidx` | Foreign key to parent class |

Plus two shared tables: `tbl_projects` (project metadata, output settings) and `tbl_projfiles` (file list per project).

### 3. Web-Based Editor UI

**Files:** `jpdocedit.php` (entry point), `jpd_editclass.php`, `jpd_editmethod.php`, `jpd_editproject.php`

The editor provides a complete web interface for managing documentation:

- **Project Management** — Create/edit projects, define which PHP files belong to each project, set output directory and format options (framed HTML or single-file).
- **Database Update** — A single button re-parses all modified source files and updates the database. A "Force" option re-parses everything regardless of timestamps.
- **Class Browser** — Displays all classes with color-coded documentation coverage scores (green = 100%, red = incomplete). Click a class to view and edit its description and cross-references.
- **Method Editor** — Edit each method's summary, full description, return value documentation, example code, and per-argument descriptions. Up to 5 method cross-references and 10 arguments supported.
- **DB Consistency Check** — Validates referential integrity of the database.

### 4. Report Generator

**Files:** `jpgendoc.php` (framework), `jpgenhtmldoc.php` (HTML formatter)

The report generator walks the class hierarchy in the database and produces formatted output via a pluggable formatter architecture:

- `ClassFormatter` — Abstract base class with virtual methods for each documentation element (`FmtClassSetup`, `FmtFuncPrototype`, `FmtFuncArgs`, `FmtIndexClass`, etc.).
- `ClassRefDriver` — Resolves inheritance chains, handles method overriding, and calls formatter hooks.
- `ClassHTMLFormatter` (in `jpgenhtmldoc.php`) — The concrete HTML formatter. Generates:
  - Per-class HTML pages with syntax-highlighted prototypes
  - Argument tables with types, descriptions, and defaults
  - Inheritance hierarchy diagrams
  - Cross-reference links between classes and methods
  - A framed index page with class table of contents
  - Project information page

The `DBCache` class pre-fetches all class and method data from MySQL into memory before generation, avoiding per-class queries.

### 5. Documentation Statistics

**Class:** `DocStat` (in `de_utils.php`)

DDDA calculates a weighted documentation completeness score:

- **Class-level score** — Based on whether the class description is filled in, plus the average score of all its methods.
- **Method-level score** — Points are awarded for: short description, full description, return value, example code, and individual argument descriptions. Each element has a configurable weight.
- The result is a **percentage** displayed in the class browser, making it immediately obvious which parts of the API need more documentation effort.

## Usage Cycle

The intended workflow was:

1. **Create a project** — Define which PHP source files belong to it.
2. **Update DB** — Parse all source files and populate the database.
3. **Write documentation** — Use the web UI to add descriptions, examples, and cross-references to classes and methods.
4. **Generate docs** — Produce HTML class reference from the database.
5. **Iterate** — As the code evolves, re-run "Update DB" to pick up new/changed methods while preserving existing documentation.

## The DDDA Paper

The `ddda-paper/` directory contains a short presentation (`index.html`) describing the DDDA concept, its motivation, and its architecture. The key argument is that embedding user-level documentation in source code (as comments) creates maintenance friction and clutters the code. By using a database as an intermediate store, the documentation lifecycle becomes independent of the code editing workflow.

## File Reference

| File | Purpose |
|------|---------|
| `jpdocedit.php` | Main entry point — project selection and class browser |
| `jpd_editproject.php` | Project and file management forms |
| `jpd_editclass.php` | Class description editor form |
| `jpd_editmethod.php` | Method/argument documentation editor form |
| `jplintphp.php` | Core PHP source parser and static analyzer |
| `jpgendb.php` | Database-aware parser — writes parsed data to MySQL |
| `jpgendbdriver.php` | Standalone driver to run the DB parser |
| `jpgendoc.php` | Report generation framework with pluggable formatters |
| `jpgenhtmldoc.php` | HTML documentation generator plugin |
| `jpdb.php` | MySQL database abstraction layer |
| `de_utils.php` | Shared utilities — DB schema, form layout engine, doc statistics, HTML helpers |
| `dbschema_ddda.php` | Visual database schema diagram generator (uses JpGraph itself) |
| `ddda_chkdb.php` | Database consistency checker |
| `jpdbdelclass.php` | Safe class deletion with referential integrity checks |
| `jplintdriver.php` | Standalone lint/static analysis driver |
| `de_normal.css` | Stylesheet for the web editor UI |

---

*DDDA was created by Johan Persson at Aditus Consulting, first released July 2002 (v1.2), last updated August 2003 (v1.4).*
