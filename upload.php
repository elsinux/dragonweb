<head>
	    <meta charset="utf-8">
</head>
<?php 
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    /*echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";*/

    if (file_exists("data/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
//write file      
		move_uploaded_file($_FILES["file"]["tmp_name"],"data/" . $_FILES["file"]["name"]);
      //echo "Stored in: " . "data/" . $_FILES["file"]["name"];
	echo $_FILES["file"]["name"]."cargado con éxito";
	$file_name = $_FILES["file"]["name"];
	$file_owner = $_REQUEST['id_owner'];
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
	$sql="INSERT INTO clientes_filesystem (file, owner_id)
	VALUES ('$file_name','$file_owner')";
	//echo $sql;
	if (!mysql_query($sql,$con))
		{ die('Error: ' . mysql_error()); }
      }
    }
?>