Respect\Foundation
==================

A conventional project tool for PHP and git.

** This is a work in progress! Several features are missing. Get in touch. **

Works out of the box with:

  * PEAR
  * Pyrus
  * Composer
  * Onion
  * Travis CI
  * Pirum
  * GitHub Pages
  * PHPUnit
  * New and pre-existing projects

Installation
------------

Make sure you have curl, git PHP and PEAR installed. On your project 
folder, run:

    curl -LO git.io/Makefile && make foundation

This command line will install and/or update your Foundation
installation.

On Ubuntu, to install everything you need you can run:

    sudo apt-get install curl php-cli php-pear git-core

Usage
-----

### make help

Shows all available targets.

### make foundation

Installs and updates your Foundation. 

### make questions

Runs an interactive command for project-config.

### make project-config

Shows the project configuration and allows editing of any of the aspects below:

#### PHP Version

This will help Composer and PEAR automations to declare the correct PHP 
version for your project. 

Examples: 5.3, 5.3.5, 5.4.

Will try to import values from any package.ini, package.xml, composer.json and
current PHP version.

#### Project Repository

Git repository this project resides. Partial repo names will default to GitHub.

Examples: git://php.net/php-src.git, zendframework/zf2

Will try to import values from .git folders, package.ini and composer.json.

#### Library Folder

Folder with PHP Classes.

Will try to import values from package.ini, package.xml, folder structure.

#### Test Folder

Folder with Test Cases.

Will try to import values from package.ini, package.xml, folder structure.

#### Config Folder

Folder with configuration.

Will try to import values from package.ini, package.xml, folder structure.

#### Public Folder

Folder with public files.

Will try to import values from package.ini, package.xml, folder structure.

#### Executables Folder

Folder with executable files and scripts.

Will try to import values from package.ini, package.xml, folder structure.

#### Vendor Name

This will be used as the top namespace for your project inside the sources
folder, will configure Composer autoloading and will be reused on other
questions.

Examples: Doctrine, Zend, Symfony, Respect, MyProject.

Will try to import values from any package.ini, package.xml, composer.json and
folder structure.

#### Package Name

Package your vendor is distributing. 

Examples: Db, DBAL, Validation, MyPackage.

Will try to import values from any package.ini, package.xml, composer.json and
folder structure.

#### Project Name

Defaults to VendorName/PackageName

Will try to import values from any package.ini, package.xml, composer.json and
README files.

#### One-line Summary

Used for PEAR and Composer.

Will try to import values from any package.ini, package.xml, composer.json and
README files.

#### Package Description

More detailed description of the package. Defaults to the One-line Summary.

#### Package Version

Defaults to 0.1.0. On PEAR packages this will be the same as the API version.

Will try to import values from any package.ini, package.xml and composer.json.

#### Package Stability

Defaults to alpha. Possible values are: alpha, beta, stable.

Will try to import values from any package.ini, package.xml and composer.json.

#### Package Authors

Accepts a comma-separated list of names and emails.

Example: Alexandre Gaigalas <alexandre@gaigalas.net>, Augusto Pascutti <augusto@phpsp.org.br>

Will try to import values from git and source files.

#### PEAR Channel

The PEAR for this project. 

Examples: pear.phpunit.de, respect.li/pear, packages.zendframework.com

Will try to import values from package.ini, package.xml and composer.json.

#### PEAR Channel git repository

Git repository that holds the PEAR channel.

#### PHAR Channel git repository

Git repository that holds the PHAR channel.

#### PEAR Dependencies

Accepts a comma-separated list of PEAR dependencies.

Example: pear.phpunit.de/PHPUnit, packages.zendframework.com/Zend_Dom-beta

Will try to import values from package.ini, package.xml and composer.json.

#### Extension Dependencies

Accepts a comma-separated list of PHP extensions.

Example: pecl/http, pecl/sockets

Will try to import values from package.ini ands package.xml.

### make structure

Creates the project directory structure and default files.

### make test case=TestCaseName filter=methodName 

Runs tests inside the project folder.

### make coverage case=TestCaseNae filter=methodName

Runs code coverage reports for the project tests.

### make clean

Remove temporary files and cleans up project structure.

### make version number=0.3.4 stability=stable

Changes the project version and stability

### make patch 

Increases the patch segment of the project version. 0.3.4 will
become 0.3.5.

### make minor

Increases the minor segment of the project version. 0.3.4 will
become 0.4.0.

### make major

Increases the major segment of the project version. 0.3.4 will
become 1.0.0.

### make alpha

Changes the stability of the current package version to alpha.

### make beta

Changes the stability of the current package version to beta.

### make stable

Changes the stability of the current package version to stable.

### make tag

Creates a git tag for the current project version. Alpha/beta tags
are suffixed with their stability. Stable releases are just the
version number.

### make pear

Creates a PEAR package for the current project version.

### make pyrus

Creates a Pyrus package for the current project version.

### make phar

Creates a Phar package of the current project version.

### make install

Installs the current project version into the local PEAR
installation.

### make bundle

Installs dependencies for the current project version into
the local PEAR installation.

### make pear-push pear_package=FooBar.tgz pear_repo=Respect/pear

Pushes the latest generated PEAR package to a git repository.

### make phar-push phar_package=FooBar.phar phar_repo=Respect/phar phar_stub=scripts/stub.php

Pushes the latest generated PHAR package to a git repository.

### make run

Opens the current project in a browser, serving it using
PHP bundled server.

### make release

Runs tests, coverage reports, generates PEAR and PHAR packages, 
tag the build and pushes the packages.

### make config inis='Doctrine.ini HttpKernel.ini' nointeractive=true

Downloads INI files for component dependencies, interactively configures
them.
