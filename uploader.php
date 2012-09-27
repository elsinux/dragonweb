<?php
// Destination folder for downloaded files
$upload_folder = 'data';
$file_owner = $_REQUEST['owner_id'];
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
	
// If the browser supports sendAsBinary () can use the array $ _FILES
if(count($_FILES)>0) { 
	if( move_uploaded_file( $_FILES['upload']['tmp_name'] , $upload_folder.'/'.$_FILES['upload']['name'] ) ) {
		$file_name=$_FILES['upload']['name'];
		$sql="INSERT INTO clientes_filesystem (file, owner_id)
		VALUES ('$file_name','$file_owner')";
		echo $sql;
		if (!mysql_query($sql,$con))
  			{ die('Error: ' . mysql_error()); }
		echo '<script>scan_data();</script>';
	}
	exit();
} else if(isset($_GET['up'])) {
	// If the browser does not support sendAsBinary ()
	if(isset($_GET['base64'])) {
		$content = base64_decode(file_get_contents('php://input'));
	} else {
		$content = file_get_contents('php://input');
	}

	$headers = getallheaders();
	$headers = array_change_key_case($headers, CASE_UPPER);
	
	if(file_put_contents($upload_folder.'/'.$headers['UP-FILENAME'], $content)) {
		$file_name=$headers['UP-FILENAME'];
		$sql="INSERT INTO clientes_filesystem (file, owner_id)
		VALUES ('$file_name','$file_owner')";
		if (!mysql_query($sql,$con))
  			{ die('Error: ' . mysql_error()); }
		//echo $sql;
		echo '<script>scan_data();</script>';
	}
	exit();
}
?>