<?php
$dbhost="datmeandb.cgklemayrjuk.eu-west-1.rds.amazonaws.com";
$dbuser="jose.carlos";
$dbpass="carlos123!";
$dbname="COMUNICACIONES_2";
$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
print_r($dbh);