<?php

echo $_POST['id_file']."<br>";
echo $_POST['name']."<br>";
if ($_POST['id_file'] <> ''){
//connect to mysql
	$con = mysql_connect("localhost","root","root");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	mysql_select_db("db_dragonweb", $con);
//set to UTF-8
	mysql_query("SET NAMES UTF8");
	mysql_query("SET CHARACTER SET utf8");
//find the BD filesystem
	$sql = "DELETE FROM clientes_filesystem WHERE id = '$_POST[id_file]'";
	$result = mysql_query($sql);
	echo $_POST['name'];
	unlink($_POST['name']);
}
?>