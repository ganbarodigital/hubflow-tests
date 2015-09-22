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

# separate out the system-under-test
SUT=$1
shift

# we need to make sure we have the copy of Hubflow that we want to test
if [[ ! -e ./tmp/hubflow-$SUT ]] ; then
    ( cd ./tmp ; git clone -b $SUT https://github.com/datasift/gitflow.git ./hubflow-$SUT && cd hubflow-$SUT && git submodule update ) || die "Unable to clone Hubflow $SUT"
fi
export PATH=`pwd`/tmp/hubflow-$SUT:$PATH

# now we just need to run the tests
vendor/bin/storyplayer -s $SUT "$@"