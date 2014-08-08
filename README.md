# MeSH Parser

## Description

Extracts MeSH descriptors and associated data from a given XML file into a SQL file
which can be inserted into a MySQL database.

### Download Executable
Go to https://github.com/ilios/mesh-parser/releases and download the latest JAR file.

#### Or Build Executable
If you want to build the mesh parser yourself then:
Run `mvn package` in the project's root directory.
This will generate an executable jar file `mesh_parser-1.1.0-jar-with-dependencies.jar` in the `target` sub-directory.

## Usage

Run the jar file whilst providing a path to the MeSH descriptor file and the destination for the output SQL

```bash
$ java -jar mesh_parser-1.1.0-jar-with-dependencies.jar <mesh-descriptor-file> <sql-output-file>
```
This will parse the given MeSH descriptor file and create the SQL file.

If you wish to test the SQL file an example database can be found in resources/db/schema/mesh_tables.sql

Input parameters:

* mesh-descriptor-file ... location of the MeSH descriptor XML file
* sql-output-file      ... location where the new SQL file should be written

## Caveats

* The DTD file corresponding to the MeSH descriptor file _must_ be located in the same directory as the descriptor file.
* The sql-output-file should not exist before running the script, it will be created.
