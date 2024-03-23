<?php


$repo = new GroupRepository(getenv('MYSQL_URL'),
                            getenv('MYSQL_USER'),
                            getenv('MYSQL_PASSWORD'),
                            getenv('MYSQL_DATABASE'));

$service = new GroupService($repo);

