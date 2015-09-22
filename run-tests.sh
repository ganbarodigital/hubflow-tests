#!/bin/bash

function die()
{
	echo "*** error: $*"
	exit 1
}

# the tests are written in PHP
if ! which php > /dev/null ; then
	die "the automated tests require PHP" ;
fi

# we need cURL to download Composer
if ! which curl > /dev/null ; then
    die "the automated tests require curl" ;
fi

# download our dependencies if there is no vendor/ folder
if [[ ! -e vendor ]] ; then

    # we need PHP's composer to manage packages
    if [[ ! -e composer.phar ]] ; then
        curl -sS https://getcomposer.org/installer | php
    fi

    # install all dependencies
    if [[ -e composer.lock ]] ; then
        php ./composer.phar update
    else
        php ./composer.phar install
    fi
fi

# at this point, Storyplayer and all of its dependencies have been
# successfully downloaded and installed
#
# we need to make sure the checked out copy of hubflow is in the path
export PATH=$(cd .. ; pwd):$PATH

# now we just need to run the tests
vendor/bin/storyplayer "$@"