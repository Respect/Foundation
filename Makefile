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
	@echo "Done."

project-config:
	@echo "\nFoundation Project Configuration\n"
	@echo "             php-version: " $(shell php .foundation/repo/bin/project-config.php php-version)
	@echo "      project-repository: " $(shell php .foundation/repo/bin/project-config.php project-repository)
	@echo "          library-folder: " $(shell php .foundation/repo/bin/project-config.php library-folder )
	@echo "             test-folder: " $(shell php .foundation/repo/bin/project-config.php test-folder )
	@echo "           config-folder: " $(shell php .foundation/repo/bin/project-config.php config-folder )
	@echo "           public-folder: " $(shell php .foundation/repo/bin/project-config.php public-folder )
	@echo "      executables-folder: " $(shell php .foundation/repo/bin/project-config.php executables-folder )
	@echo "             vendor-name: " $(shell php .foundation/repo/bin/project-config.php vendor-name )
	@echo "            package-name: " $(shell php .foundation/repo/bin/project-config.php package-name )
	@echo "            project-name: " $(shell php .foundation/repo/bin/project-config.php project-name )
	@echo "        one-line-summary: " $(shell php .foundation/repo/bin/project-config.php one-line-summary )
	@echo "     package-description: " $(shell php .foundation/repo/bin/project-config.php package-description )
	@echo "         package-version: " $(shell php .foundation/repo/bin/project-config.php package-version )
	@echo "       package-stability: " $(shell php .foundation/repo/bin/project-config.php package-stability )
	@echo "         package-authors: " $(shell php .foundation/repo/bin/project-config.php package-authors )
	@echo "            pear-channel: " $(shell php .foundation/repo/bin/project-config.php pear-channel )
	@echo "         pear-repository: " $(shell php .foundation/repo/bin/project-config.php pear-repository )
	@echo "         phar-repository: " $(shell php .foundation/repo/bin/project-config.php phar-repository )
	@echo "       pear-dependencies: " $(shell php .foundation/repo/bin/project-config.php pear-dependencies )
	@echo "  extension-dependencies: " $(shell php .foundation/repo/bin/project-config.php extension-dependencies )
	@echo ""

questions:

structure:

.PHONY: test
test:
	@cd $(shell php .foundation/repo/bin/project-config.php test-folder );phpunit .

coverage:

clean:

patch:  

minor:

major:

alpha:

beta:

stable:

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