CONFIG_TOOL   = php .foundation/repo/bin/project-config.php
GENERATE_TOOL = php .foundation/repo/bin/project-generate.php

default:
	@echo "Foundation. See 'make help' for instructions."

help:
	@echo "\nFoundation Help\n"
	@echo "            help: Shows this message"
	@echo "      foundation: Installs and updates Foundation"
	@echo "  project-config: Shows project configuration"
	@echo "       questions: Runs into project configuration interactively"
	@echo "       structure: Creates files and folders for the project, exclude='' \n\
	                  any exceptions"
	@echo "            test: Run project tests"
	@echo "        coverage: Run project tests and reports coverage status"
	@echo "           clean: Removes temporary files"
	@echo "           patch: Increases the patch version of the project (X.X.++)"
	@echo "           minor: Increases the minor version of the project (X.++.0)"
	@echo "           major: Increases the major version of the project (++.0.0)"
	@echo "           alpha: Changes the stability of the current version to alpha"
	@echo "            beta: Changes the stability of the current version to beta"
	@echo "          stable: Changes the stability of the current version to stable"
	@echo "             tag: Makes a git tag of the current project version/stability"
	@echo "            pear: Generates a PEAR package"
	@echo "            phar: Generates a Phar package"
	@echo "           pyrus: Generates a Pyrus package"
	@echo "          bundle: Install dependencies for this project in the local PEAR"
	@echo "         install: Install this project and its dependencies in the local PEAR"
	@echo "       pear-push: Pushes the latest PEAR package. Custom pear_repo='' and \n\
	                  pear_package='' available."
	@echo "       phar-push: Pushes the latest Phar package. Custom phar_repo='', \n\
	                  phar_package='' and phar_stub='' available."
	@echo "             run: Runs the current project into a server and opens it in a browser."
	@echo "         release: Runs tests, coverage reports, generates packages, tag the build \n\
	                  and pushes to package repositories" 
	@echo "          config: Downloads INI dependencies, interactively configure them"
	@echo "" 

foundation:
	@echo "Updating Makefile"
	curl -LO git.io/Makefile
	@echo "Creating .foundation folder"
	-rm -Rf .foundation
	-mkdir .foundation
	git clone git://github.com/Respect/Foundation.git .foundation/repo
	@echo "Downloading Onion"
	-curl -L https://github.com/c9s/Onion/raw/master/onion > .foundation/onion;chmod +x .foundation/onion
	@echo "Downloading Pyrus"
	-curl -L http://pear2.php.net/pyrus.phar > .foundation/pyrus;chmod +x .foundation/pyrus
	@echo "Done."

project-config:
	@echo "\nFoundation Project Configuration\n"
	@echo "             php-version: " `$(CONFIG_TOOL) php-version`
	@echo "      project-repository: " `$(CONFIG_TOOL) project-repository`
	@echo "          library-folder: " `$(CONFIG_TOOL) library-folder `
	@echo "             test-folder: " `$(CONFIG_TOOL) test-folder `
	@echo "           config-folder: " `$(CONFIG_TOOL) config-folder `
	@echo "           public-folder: " `$(CONFIG_TOOL) public-folder `
	@echo "      executables-folder: " `$(CONFIG_TOOL) executables-folder `
	@echo "             vendor-name: " `$(CONFIG_TOOL) vendor-name `
	@echo "            package-name: " `$(CONFIG_TOOL) package-name `
	@echo "            project-name: " `$(CONFIG_TOOL) project-name `
	@echo "             readme-file: " `$(CONFIG_TOOL) readme-file `
	@echo "        one-line-summary: " `$(CONFIG_TOOL) one-line-summary `
	@echo "     package-description: " `$(CONFIG_TOOL) package-description `
	@echo "         package-version: " `$(CONFIG_TOOL) package-version `
	@echo "       package-stability: " `$(CONFIG_TOOL) package-stability `
	@echo "         package-authors: " `$(CONFIG_TOOL) package-authors `
	@echo "            pear-channel: " `$(CONFIG_TOOL) pear-channel `
	@echo "         pear-repository: " `$(CONFIG_TOOL) pear-repository `
	@echo "         phar-repository: " `$(CONFIG_TOOL) phar-repository `
	@echo "       pear-dependencies: " `$(CONFIG_TOOL) pear-dependencies `
	@echo "  extension-dependencies: " `$(CONFIG_TOOL) extension-dependencies `
	@echo ""

questions:

structure:
	@$(GENERATE_TOOL) package-ini > package.ini.tmp && mv -f package.ini.tmp package.ini

.PHONY: test
test:
	@cd `$(CONFIG_TOOL) test-folder`;phpunit .

coverage:

clean:

patch:  
	@$(GENERATE_TOOL) package-ini patch > package.ini.tmp && mv -f package.ini.tmp package.ini

minor:
	@$(GENERATE_TOOL) package-ini minor > package.ini.tmp && mv -f package.ini.tmp package.ini

major:
	@$(GENERATE_TOOL) package-ini major > package.ini.tmp && mv -f package.ini.tmp package.ini

alpha:
	@$(GENERATE_TOOL) package-ini alpha > package.ini.tmp && mv -f package.ini.tmp package.ini

beta:
	@$(GENERATE_TOOL) package-ini beta > package.ini.tmp && mv -f package.ini.tmp package.ini

stable:
	@$(GENERATE_TOOL) package-ini stable > package.ini.tmp && mv -f package.ini.tmp package.ini

tag:

pear:

pyrus:

phar:

install:

bundle:

pear-push:

phar-push:

run:

release:

config: