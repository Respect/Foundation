VERSION       = 0.1.12
CONFIG_TOOL   = .foundation/repo/bin/project-config.php
GENERATE_TOOL = .foundation/repo/bin/project-generate.php
SHELL         = /bin/sh
PACKAGES_PEAR = pear config-get php_dir

.title:
	@echo "Respect/Foundation - $(VERSION)\n"

.check-foundation: .title
	@test -d .foundation || make -f Makefile foundation
# Help is not the default target cause its mainly used as the main
# build command. We're reserving it.
default: .title
	@echo "                          ====================================================================="
	@echo "                          Respect/Foundation Menu"
	@echo "                          ====================================================================="
	@echo "                    help: Shows Respect/Foundation Help Menu: type: make help"
	@echo "              foundation: Installs and updates Foundation"
	@echo "                          ====================================================================="
	@echo "                          Other Targets Menus"
	@echo "                          ====================================================================="
	@echo "            project-menu: Project Scripts Menu"
	@echo "            package-menu: Show Packaging Toolbox Menu"
	@echo "                dev-menu: Show Dev Toolbox Menu"
	@echo "             deploy-menu: Show Deploy & Release"
	@echo ""

help: .title
	@echo "                          ====================================================================="
	@echo "                          Respect/Foundation Help"
	@echo "                          ====================================================================="
	@echo "                          Info: As you probably figured out by now the menu lists the make"
	@echo "                                targets on the left, right aligned like Happy Pandas and the"
	@echo "                                descriptions listed in the menu block like this."
	@echo ""
	@echo "                                To make use of any targets you simply add the target name after"
	@echo "                                make cammand in your shell."
	@echo ""
	@echo "                          Example: make help"
	@echo ""
	@echo "                          Which will bring up this screen."
	@echo "                          ====================================================================="
	@echo "               help-menu: The target for the help-menu, for more info, enter: make help-menu"
	@echo "                          ====================================================================="
	@echo "                          Info: For developers: if you happen to get the following error:"
	@echo ""
	@echo "                                       make: *** [target-name] Error 255"
	@echo ""
	@echo "                                It means the shell command that was executed for this target has"
	@echo "                                failed and the problem lies not with the Makefile."
	@echo "                          ====================================================================="
	@echo "                          Note: Respect/Foundation is currently still under active development"
	@echo "                                and such is the affairs with the help as well, I am affraid."
	@echo "                                More information will be added here in the future, if you want"
	@echo "                                to give us a hand there's no better time than now."
	@echo "                          ====================================================================="
	@echo ""

help-menu: .title
	@echo "                          ====================================================================="
	@echo "                          Respect/Foundation Help Menu"
	@echo "                          ====================================================================="
	@echo "                          Info: The make targets listed on the left, serves as navigation to"
	@echo "                                the sections where you might find more information."
	@echo ""
	@echo "                                To make use of any targets you simply add the target name after"
	@echo "                                make cammand in your shell."
	@echo ""
	@echo "                          Example: make help-menu"
	@echo ""
	@echo "                                Do the same with any of the targets listed here."
	@echo "                          ====================================================================="
	@echo "            help-skelgen: Information about PHPUnit_SkelGen and how it is facilitated through"
	@echo "                                Respect/Foundation to make your life a little easier."
	@echo "                          ====================================================================="
	@echo "                          Note: Respect/Foundation is currently still under active development"
	@echo "                                and such is the affairs with the help as well, I am affraid."
	@echo "                                More information will be added here in the future, if you want"
	@echo "                                to give us a hand there's no better time than now."
	@echo "                          ====================================================================="
	@echo ""
help-skelgen: .title
	@echo "                          ====================================================================="
	@echo "                          Respect/Foundation Help - Skelgen"
	@echo "                          ====================================================================="

	@echo "            info-skelgen: Info: Generate boilerplate PHPUnit skeleton tests per class of already"
	@echo "                                implemented source code."
	@echo ""
	@echo "                                We have greatly reduced the complexity involved with using this"
	@echo "                                utility. All you need to provide is the fully qualified classname"
	@echo "                                of the the source you want to generate the unit test for."
	@echo "                                 * We will find the class in question;"
	@echo "                                 * We will bootstrap the gen bot so it doesn't complain;"
	@echo "                                 * Based on the project info we know where the tests should go."
	@echo ""
	@echo "                          Usage:"
	@echo "                                make test-skelgen class:\"My\Awesome\Class"
	@echo ""
	@echo "            test-skelgen: Info: Generate boilerplate PHPUnit skeleton tests per class of already"
	@echo "                                implemented source code."
	@echo ""
	@echo "                                We have greatly reduced the complexity involved with using this"
	@echo "                                utility. All you need to provide is the fully qualified classname"
	@echo "                                of the the source you want to generate the unit test for."
	@echo "                                 * We will find the class in question;"
	@echo "                                 * We will bootstrap the gen bot so it doesn't complain;"
	@echo "                                 * Based on the project info we know where the tests should go."
	@echo ""
	@echo "                          Usage:"
	@echo "                                make test-skelgen class:\"My\Awesome\Class"
	@echo ""
	@echo ""
	@echo "                          Not yet implemented following references skelgen assertion shorthand"
	@echo ""
	@echo "                            @assert (...) == X     \tassertEquals(X, method(...))"
	@echo "                            @assert (...) != X     \tassertNotEquals(X, method(...))"
	@echo "                            @assert (...) === X    \tassertSame(X, method(...))"
	@echo "                            @assert (...) !== X    \tassertNotSame(X, method(...))"
	@echo "                            @assert (...) > X      \tassertGreaterThan(X, method(...))"
	@echo "                            @assert (...) >= X     \tassertGreaterThanOrEqual(X, method(...))"
	@echo "                            @assert (...) < X      \tassertLessThan(X, method(...))"
	@echo "                            @assert (...) <= X     \tassertLessThanOrEqual(X, method(...))"
	@echo "                            @assert (...) throws X \t@expectedException X"
	@echo ""

project-menu: .title
	@echo "                          ====================================================================="
	@echo "                          Respect/Foundation Menu 1"
	@echo "                          ====================================================================="
	@echo "                          Project Scripts"
	@echo "                          ====================================================================="
	@echo "            project-info: Shows project configuration"
	@echo "            project-init: Initilize current folder and create boilerplate project structure"
	@echo "           bootstrap-php: Create all purpose bootstrap.php for phpunit in test folder"
	@echo "       bootstrap-php-opt: Optimized all purpose bootstrap.php with static pear path in test folder"
	@echo "             phpunit-xml: Create phpunit.xml in test folder"
	@echo "            test-skelgen: Generate boilerplate PHPUnit skeleton tests per class see help-skelgen"
	@echo "                    test: Run project tests"
	@echo "                coverage: Run project tests and report coverage status"
	@echo "                   clean: Removes code coverage reports"
	@echo "                cs-fixer: Run PHP Coding Standards Fixer to ensure your cs-style is correct"
	@echo "               codesniff: Run PHP Code Sniffer to generate a report of code analysis"
	@echo "                  phpdoc: Run PhpDocumentor2 to generate the project API documentation"
	@echo "             package-ini: Creates the basic package.ini file"
	@echo "             package-xml: Propagates changes from package.ini to package.xml"
	@echo "           composer-json: Propagates changes from package.ini to composer.json"
	@echo "       composer-validate: Validate composer.json for syntax and other problems"
	@echo "        composer-install: Install this project with composer which will create vendor folder"
	@echo "         composer-update: Update an exiting composer instalation and refresh repositories"
	@echo "                 package: Generates package.ini, package.xml and composer.json files"
	@echo "                    pear: Generates a PEAR package"
	@echo "                 install: Install this project and its dependencies in the local PEAR"
	@echo ""



package-menu: .title
	@echo "                          ====================================================================="
	@echo "                          Respect/Foundation Menu 2"
	@echo "                          ====================================================================="
	@echo "                          Toolbox - Packaging"
	@echo "                          ====================================================================="
	@echo "                info-php: Show information about your PHP"
	@echo "              config-php: Locate your PHP configuration file aka. php.ini"
	@echo "             include-php: Show the PHP configured (php.ini) include path"
	@echo "               info-pear: Show information about your PEAR"
	@echo "             locate-pear: Locate the PEAR packages installation folder"
	@echo "            install-pear: PEAR installation instructions"
	@echo "            updated-pear: See if there are any updates for PEAR and the installed packages"
	@echo "         update-all-pear: Update all packages if any updates are available"
	@echo "           packages-pear: Show the list of PEAR installed packages and their version numbers"
	@echo "             verify-pear: Verify that we can include System.php in PHP script"
	@echo "         info-check-pear: PEAR installation verification checklist instructions"
	@echo "            check-pear-1: PEAR Checklist: 1. list PEAR commands"
	@echo "            check-pear-2: PEAR Checklist: 2. PEAR version information aka. make info-pear"
	@echo "            check-pear-3: PEAR Checklist: 3. locate package install folder aka. make locate-pear"
	@echo "            check-pear-4: PEAR Checklist: 4. verify path configured in PHP aka. make include-php"
	@echo "            check-pear-5: PEAR Checklist: 5. include PEAR System.php check aka. make verify-pear"
	@echo "              info-pyrus: Show information about your PEAR2_Pyrus - PEAR2 Installer"
	@echo "           install-pyrus: Downlod and install PEAR2_Pyrus"
	@echo "           info-composer: Show information about your composer"
	@echo "        install-composer: Downlod and install composer"
	@echo ""



dev-menu: .title
	@echo "                          ====================================================================="
	@echo "                          Respect/Foundation Menu 3"
	@echo "                          ====================================================================="
	@echo "                          Toolbox - Development"
	@echo "                          ====================================================================="
	@echo "           info-cs-fixer: Show information about your installed PHP Coding Standards Fixer"
	@echo "        install-cs-fixer: Install PHP Coding Standards Fixer"
	@echo "          info-codesniff: Show information about your installed PHP_CodeSniffer"
	@echo "       install-codesniff: Install PHP_CodeSniffer"
	@echo "       install-psr-sniff: Install Code Sniffer PSR sniffs to allow for PSR 0-3 compliancy checks"
	@echo "            info-phpunit: Show information about your installed PHPUnit"
	@echo "         install-phpunit: Install PHPUnit"
	@echo "            info-skelgen: Show information about your installed PHPUnit Skeleton Generator"
	@echo "         install-skelgen: Install PHPUnit Skeleton Generator"
	@echo "             info-phpdoc: Show information about your installed PhpDocumentor2"
	@echo "          install-phpdoc: Install PhpDocumentor2"
	@echo "              info-phpsh: Show information about your installed PHP Shell (phpsh)"
	@echo "           install-phpsh: Install PHP Shell (phpsh) - Requires Python"
	@echo "    install-uri-template: Install uri_template a php extension. Might require sudo."
	@echo ""



deploy-menu: .title
	@echo "                      ====================================================================="
	@echo "                      Respect/Foundation Menu 4"
	@echo "                      ====================================================================="
	@echo "                      Deploy & Release"
	@echo "                      ====================================================================="
	@echo "               patch: Increases the patch version of the project (X.X.++)"
	@echo "               minor: Increases the minor version of the project (X.++.0)"
	@echo "               major: Increases the major version of the project (++.0.0)"
	@echo "               alpha: Changes the stability of the current version to alpha"
	@echo "                beta: Changes the stability of the current version to beta"
	@echo "              stable: Changes the stability of the current version to stable"
	@echo "                 tag: Makes a git tag of the current project version/stability"
	@echo "               pear-push: Pushes the latest PEAR package. Custom pear_repo='' and pear_package='' available."
	@echo "                 release: Runs tests, coverage reports, tag the build and pushes to package repositories"
	@echo ""



# Foundation puts its files into .foundation inside your project folder.
# You can delete .foundation anytime and then run make foundation again if you need
foundation: .title
	@echo "Updating Makefile"
	curl -LO git.io/Makefile
	@echo "Creating .foundation folder"
	-rm -Rf .foundation
	-mkdir .foundation
	git clone --depth 1 git://github.com/Respect/Foundation.git .foundation/repo
	@echo "Downloading Onion"
	-curl -L https://github.com/c9s/Onion/raw/master/onion > .foundation/onion;chmod +x .foundation/onion
	@echo "Done."

# Target for Respect/Foundation development and internal use only. This target will not appear on the menus.
foundation-develop: .title
	@echo "Updating Makefile"
	curl -LO https://raw.github.com/Respect/Foundation/develop/Makefile
	@echo "Creating .foundation folder"
	-rm -Rf .foundation
	-mkdir .foundation
	git clone --depth 1 git://github.com/Respect/Foundation.git .foundation/repo
	cd .foundation/repo/ && git fetch && git checkout develop && cd -
	@echo "Downloading Onion"
	-curl -L https://github.com/c9s/Onion/raw/master/onion > .foundation/onion;chmod +x .foundation/onion
	@echo "Done."

project-info: .check-foundation
	@echo "\nProject Information\n"
	@echo "             php-version:" `$(CONFIG_TOOL) php-version `
	@echo "      project-repository:" `$(CONFIG_TOOL) project-repository `
	@echo "          library-folder:" `$(CONFIG_TOOL) library-folder `
	@echo "             test-folder:" `$(CONFIG_TOOL) test-folder `
	@echo "           config-folder:" `$(CONFIG_TOOL) config-folder `
	@echo "           public-folder:" `$(CONFIG_TOOL) public-folder `
	@echo "           vendor-folder:" `$(CONFIG_TOOL) vendor-folder `
	@echo "          sandbox-folder:" `$(CONFIG_TOOL) sandbox-folder `
	@echo "    documentation-folder:" `$(CONFIG_TOOL) documentation-folder `
	@echo "      executables-folder:" `$(CONFIG_TOOL) executables-folder `
	@echo "             vendor-name:" `$(CONFIG_TOOL) vendor-name `
	@echo "            package-name:" `$(CONFIG_TOOL) package-name `
	@echo "            project-name:" `$(CONFIG_TOOL) project-name `
	@echo "        one-line-summary:" `$(CONFIG_TOOL) one-line-summary `
	@echo "     package-description:" `$(CONFIG_TOOL) package-description `
	@echo "         package-version:" `$(CONFIG_TOOL) package-version `
	@echo "       package-stability:" `$(CONFIG_TOOL) package-stability `
	@echo "\r         project-authors: "`$(CONFIG_TOOL) package-authors ` \
		| tr ',' '\n' \
		| awk -F' <' '{ printf "                         %-10-s \t<%15-s \n",$$1,$$2 }'
	@echo "\r    project-contributors: "`$(CONFIG_TOOL) package-contributors ` \
		| tr ',' '\n' \
		| awk -F' <' '{ printf "                         %-10-s \t<%15-s \n",$$1,$$2 }'

	@echo "       package-date-time:" `$(CONFIG_TOOL) package-date-time `
	@echo "               pear-path:" `$(CONFIG_TOOL) pear-path `
	@echo "            pear-channel:" `$(CONFIG_TOOL) pear-channel `
	@echo "         pear-repository:" `$(CONFIG_TOOL) pear-repository `
	@echo "         phar-repository:" `$(CONFIG_TOOL) phar-repository `
	@echo "       pear-dependencies:" `$(CONFIG_TOOL) pear-dependencies `
	@echo "  extension-dependencies:" `$(CONFIG_TOOL) extension-dependencies `
	@echo "             readme-file:" `$(CONFIG_TOOL) readme-file `
	@echo "         project-license:" `$(CONFIG_TOOL) project-license `
	@echo "        project-homepage:" `$(CONFIG_TOOL) project-homepage `
	@echo "               user-name:" `$(CONFIG_TOOL) user-name `
	@echo "              user-email:" `$(CONFIG_TOOL) user-email `
	@echo "               user-home:" `$(CONFIG_TOOL) user-home `
	@echo ""

# Two-step generation including a tmp file to avoid streaming problems
package-ini: .check-foundation
	@$(GENERATE_TOOL) package-ini > package.ini.tmp && mv -f package.ini.tmp package.ini

# Generates a package.xml from the package.ini
package-xml: .check-foundation
	@.foundation/onion build

composer-json: .check-foundation
	@$(GENERATE_TOOL) composer-json > composer.json.tmp && mv -f composer.json.tmp composer.json

# Generates all package files
package: .check-foundation package-ini package-xml composer-json

# Phony target so the test folder don't conflict
.PHONY: test
test: .check-foundation
	@cd `$(CONFIG_TOOL) test-folder`;phpunit --testdox .

coverage: .check-foundation
	@cd `$(CONFIG_TOOL) test-folder`;phpunit  --coverage-html=reports/coverage --coverage-text .
	@echo "Done. Reports also available on `$(CONFIG_TOOL) test-folder`/reports/coverage/index.html"

cs-fixer: .check-foundation
	@cd `$(CONFIG_TOOL) library-folder`;php-cs-fixer -v fix --level=all --fixers=indentation,linefeed,trailing_spaces,unused_use,return,php_closing_tag,short_tag,visibility,braces,extra_empty_lines,phpdoc_params,eof_ending,include,controls_spaces,elseif .
	@echo "Library folder done. `$(CONFIG_TOOL) library-folder`"
	@cd `$(CONFIG_TOOL) test-folder`;php-cs-fixer -v fix --level=all --fixers=indentation,linefeed,trailing_spaces,unused_use,return,php_closing_tag,short_tag,visibility,braces,extra_empty_lines,phpdoc_params,eof_ending,include,controls_spaces,elseif .
	@echo "Test folder done. `$(CONFIG_TOOL) test-folder` "
	@echo "Done. You may verify the changes and commit if you are happy."

# Any cleaning mechanism should be here
clean: .check-foundation
	@rm -Rf `$(CONFIG_TOOL) test-folder`/reports

# Targets below use the same rationale. They change the package.ini file, so you'll need a
# package-sync after them
patch: .check-foundation
	@$(GENERATE_TOOL) package-ini patch > package.ini.tmp && mv -f package.ini.tmp package.ini

minor: .check-foundation
	@$(GENERATE_TOOL) package-ini minor > package.ini.tmp && mv -f package.ini.tmp package.ini

major: .check-foundation
	@$(GENERATE_TOOL) package-ini major > package.ini.tmp && mv -f package.ini.tmp package.ini

alpha: .check-foundation
	@$(GENERATE_TOOL) package-ini alpha > package.ini.tmp && mv -f package.ini.tmp package.ini

beta: .check-foundation
	@$(GENERATE_TOOL) package-ini beta > package.ini.tmp && mv -f package.ini.tmp package.ini

stable: .check-foundation
	@$(GENERATE_TOOL) package-ini stable > package.ini.tmp && mv -f package.ini.tmp package.ini

tag: .check-foundation
	-git tag `$(CONFIG_TOOL) package-version ` -m 'Tagging.'

# Runs on the current package.xml file
pear:
	@pear package

# On root PEAR installarions, this need to run as sudo
install: .check-foundation
	@echo "You may need to run this as sudo."
	@echo "Discovering channel"
	-@pear channel-discover `$(CONFIG_TOOL) pear-channel`
	@pear install package.xml

get-composer: .check-foundation
	@echo "Attempting to download composer packager."
	curl -s http://getcomposer.org/installer | php

composer-validate: .check-foundation
	@echo "Running composer validate, be brave."
	php composer.phar validate -v

composer-install: .check-foundation
	@echo "Running composer install, this will create a vendor folder and congigure autoloader."
	php composer.phar install -v

composer-update: .check-foundation
	@echo "Running composer update, which updates your existing installarion."
	php composer.phar update -v

# Install pirum, clones the PEAR Repository, make changes there and push them.
pear-push: .check-foundation
	@echo "Installing Pirum"
	@sudo pear install --soft --force pear.pirum-project.org/Pirum
	@echo "Cloning channel from git" `$(CONFIG_TOOL) pear-repository`
	-rm -Rf .foundation/pirum
	git clone --depth 1 `$(CONFIG_TOOL) pear-repository`.git .foundation/pirum
	pirum add .foundation/pirum `$(CONFIG_TOOL) package-name`-`$(CONFIG_TOOL) package-version`.tgz;pirum build .foundation/pirum;
	cd .foundation/pirum;git add .;git commit -m "Added " `$(CONFIG_TOOL) package-version`;git push

packagecommit:
	@git add package.ini package.xml composer.json
	@git commit -m "Updated package files"

# Uses other targets to complete the build
release: test package packagecommit pear pear-push tag
	@echo "Release done. Pushing to GitHub"
	@git push
	@git push --tags
	@echo "Done. " `$(CONFIG_TOOL) package-name`-`$(CONFIG_TOOL) package-version`
