<?php
$db_host	  = '5893b7750c1e665026000010-freshboybg.rhcloud.com:49151';
$db_user	  = 'admingRsCPhx';
$db_pass      = '8atwVzR3QqVw';
$db_database  = 'yt';

$bd = mysql_connect ($db_host,$db_user,$db_pass) or die(mysql_error());
mysql_select_db ($db_database,$bd)  or die(mysql_error());
mysql_query("set names utf8"); 
?>
