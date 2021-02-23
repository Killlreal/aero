#!/bin/sh

if ! [ 777 = $(stat -f "%OLp" ./public/admin/pl) ];
then
    chmod -R 777 ./public/admin/pl
fi;

if ! [ 777 = $(stat -f "%OLp" ./public/data) ];
then
    chmod -R 777 ./public/data
fi;

if ! [ -f ./public/admin/pl/Administrator.php ]
then
    cp ./.users/Administrator.php ./public/admin/pl/Administrator.php
    chmod -R 777 ./public/admin/pl/Administrator.php
fi;

if ! [ -f ./public/admin/pl/Developer.php ]
then
    cp ./.users/Developer.php ./public/admin/pl/Developer.php
    chmod -R 777 ./public/admin/pl/Developer.php
fi;
