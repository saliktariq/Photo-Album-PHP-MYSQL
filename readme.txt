INTRODUCTION:

Photo is a basic application that displays photos that are uploaded by the user. The application also displays
information stored in the database.

The main URL of the application is at: http://titan.dcs.bbk.ac.uk/~mtariq01/w1fma/

The application also provides JSON feed. Which can be accessed at:

http://titan.dcs.bbk.ac.uk/~mtariq01/w1fma/endpoint.php

You will need to provide the id of the photo whose data you want to retrieve. For example: if you want to retrieve
data relevant to photo with id 4. You will have to pass in the following URL to access JSON data:

http://titan.dcs.bbk.ac.uk/~mtariq01/w1fma/endpoint.php?id=4

PROJECT'S AIM:

1) Ensure portability of application.
2) Design for change in mind.
3) Separation of concerns, i.e., Presentation layer, Data Access layer and Business Logic layer.
4) Ensure consistency of design across the application views.
5) Easy manageability of PHP and HTML code.
6) To be able to safely upload files.
7) To be able to do validation checks on uploaded files.
8) To be able to create JSON feed from a given data source.

DATABASE INSTALLATION:

This project includes a file 'createDataStructure.sql' located within /sql folder containing the structure of table.
This sql query can simply be executed on a MySQL server to produce required tables. This script can be run from an
application like MySQL WorkBench to install the data structure.

DATABASE ACCESS:

PHP Data Object PDO is used for data access and data transactions. Class MyPDO.php is creates as child class of PDO class,
any modification to the data source must be done in this extended child class. MyPDO.php is located in /classes folder.

FILE STRUCTURE:

INDEX.PHP: This file provides single point of entry into the application.

All of the views are stored within /views folder. There are 4 files within this folder:

404.php
upload.php
home.php
largephoto.php

These are pure PHP files and does not contain any HTML.

All of the HTML is contained in /templates folder. Any modification to the appearance of the application must be attempted
within these HTML files.

WARNING: Do not alter or modify any label within double curly brackets eg, {{LABEL}} as these are
the placeholders for dynamic content.

Cascade Style Sheet is stored in /css folder.

The /data_access folder contains all the files responsible for interacting with database. These files are responsible for
Data Access, hence files contained in this folder form the Data Access Layer of the application.

The /presentation folder contains all the files responsible for generating html from the data accessed from /data_access
files.

INTERNATIONALISATION:

The /lang folder contains the language files which contains all the static text found within the app. Any text displayed
in the application can be altered by changing the relevant $lang[] array variable. Language files are stored using there
2 character ISO 639-1 codes followed by .php extension.

APPLICATION SETTINGS:

Files containing the most important settings and business logic are contained in the /includes folder.

CONFIG.INC.PHP:

This file contains all the database connection settings and credentials, along with configuration to change the application
language. PLEASE MAKE A COPY OF THIS FILE BEFORE MAKING ANY CHANGES SO THAT UNDESIRABLE CHANGES CAN BE REVERTED.

FUNCTIONS.PHP:

This file contains all the functions that help to make the code precise.

SQL_QUERIES.PHP: This file contains variables containing the SQL queries used in the application. Any changes to the queries
must be done here.

SET_LANGUAGE.PHP: This file updates the language preference of the app user and loads relevant locale file.


Salik Tariq.