# MeSH Parser

## Description

Extracts MeSH descriptors and associated data from a given XML file into a MySQL database.

## Installation

### Setup Database Tables

Log in to your database-server and create a new database.

```mysql
CREATE DATABASE `mesh_universe`;
USE `mesh_universe`;
```

Then `SOURCE` the `mesh_tables.sql` script into it. This will create the various `mesh_*` tables.

```mysql
SOURCE resources/db/schema/mesh_tables.sql;
```

### Build Executable

Run `mvn package` in the project's root directory.
This will generate an executable jar file `mesh_parser-1.0.0-SNAPSHOT-jar-with-dependencies.jar` in the `target` sub-directory.

## Usage

Run the generated jar file whilst providing a path to the MeSH descriptor file, and database connection parameters.

```bash
$ java -jar target/mesh_parser-1.0.0-SNAPSHOT-jar-with-dependencies.jar <mesh-descriptor-file> <db-host> <db-name> <db-user> <db-password>
```
This will parse the given MeSH descriptor file and import its data into the specified database.

Input parameters:

* mesh-descriptor-file ... location of the MeSH descriptor XML file
* db-host ... database-server hostname or IP-address
* db-name ... database name
* db-user ... db username
* db-password ... db user password

## Caveats

* The DTD file corresponding to the MeSH descriptor file _must_ be located in the same directory as the descriptor file.
* Currently, there is no way to specify a database-server port, so the default-port 3306 is always assumed.

