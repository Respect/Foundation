# a Courtesy of Respect/Foundation
#
# Travis configuration see http://about.travis-ci.org/docs/user/languages/php/ for more hints
#
# Build Lifecycle
#
#  By default, the worker performs the build as following:
#
#  * Switch language runtime (for example, to PHP 5.3 or PHP 5.4)
#  * Clone project repository from GitHub
#  * Run before_install scripts (if any)
#  * cd to the clone directory, run dependencies installation command (default specific to project language)
#  * Run after_install scripts (if any)
#  * Run before_script scripts (if any)
#  * Run test script command (default is specific to project language) - exit code 0 on success.
#  * Run after_script scripts (if any)
#
#  The outcome of any of these commands indicates whether or not this build has failed or passed.
#  The standard Unix exit code of "0" means the build passed; everything else is treated as failure.
#
# define language:
# language: php
#
# list any PHP version you want to test against
# php:
# using major version aliases
#
# aliased to 5.2.17
#   - 5.2
# aliased to a recent 5.3.x version
#   - 5.3
# aliased to a recent 5.4.x version
#   - 5.4

language: php

php:
  - 5.3
  - 5.4

# you can override dependency installation command using install option:
# install: ant install-deps
#
# define scripts to be run before and after the dependency installation script:
#
# before_install:
#   - before_command_1
#   - before_command_2
# after_install:
#   - after_command_1
#
# optionally specify a list of environments, for example to test different RDBMS
# env:
#   - DB=mysql
#   - DB=pgsql
#
# execute any number of scripts before the test run, custom env's are available as variables
# before_script:
#   - if [[ "$DB" == "pgsql" ]]; then psql -c "DROP DATABASE IF EXISTS hello_world_test;" -U postgres; fi
#   - if [[ "$DB" == "pgsql" ]]; then psql -c "create database hello_world_test;" -U postgres; fi
#   - if [[ "$DB" == "mysql" ]]; then mysql -e "create database IF NOT EXISTS hello_world_test;" -uroot; fi
#
# before_script:
#   - before_command_1
#   - before_command_2
# after_script:
#   - after_command_1
#   - after_command_2
#
# omitting "script:" will default to phpunit
# use the $DB env variable to determine the phpunit.xml to use
# script: phpunit --configuration phpunit_$DB.xml --coverage-text

before_script:
  - make foundation-develop
  - make composer-install

script:
  - make test

# white- or blacklist branches that you want to be built:
# to blacklist branches
# branches:
#   except:
#     - legacy
#     - experimental
#
# or whitelist branches:
# branches:
#   only:
#     - master
#     - stable
#
# use regular expressions to white- or blacklist branches:
# branches:
#   only:
#     - master
#     - /^deploy-.*$/
#
# Any name surrounded with / in the list of branches is treated as a regular expression and can contain
# all kinds of quantifiers, anchors, and character classes supported by Ruby.
# see: http://www.ruby-doc.org/core-1.9.3/Regexp.html
#
# configure notifications (email, IRC, campfire etc)
#
# specify recipients that will be notified about build results like so:
# notifications:
#   email:
#     recipients:
#       - one@example.com
#       - other@example.com
#     on_success: [always|never|change] # default: change
#     on_failure: [always|never|change] # default: always
#
# specify notifications sent to an IRC channel:
# notifications:
#   irc:
#     channels:
#       - "irc.freenode.org#travis"
#       - "irc.freenode.org#some-other-channel"
#     on_success: [always|never|change] # default: always
#     on_failure: [always|never|change] # default: always
#     use_notice: true
#     skip_join: true

notifications:
  irc:
    channels:
      - "irc.freenode.org#php-respect"
    use_notice: true

# customize the message that will be sent to the channel(s) with a template:
#    template:
#      - "%{repository_url} (%{commit}) : %{message} %{foo} "
#      - "Build details: %{build_url}"
#
# You can interpolate the following variables:
#
#   repository_url: your GitHub repo URL.
#   build_number: build number.
#   branch: branch build name.
#   commit: shorten commit SHA
#   author: commit author name.
#   message: travis message to the build.
#   compare_url: commit change view URL.
#   build_url: URL of the build detail.
#
