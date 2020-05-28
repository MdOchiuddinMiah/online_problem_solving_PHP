<?php
error_reporting(E_PARSE | E_ERROR);
mysql_connect("localhost", "root", "") or die("can not connect..");
mysql_select_db("online_problem_solving") or die("can not find db");
?>

