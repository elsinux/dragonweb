<?php
//echo $_POST['owner_id'];

if (!$_POST['owner_id']==''){
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
	if($_POST['owner_id']=='3'){
//admin user
		$sql = "SELECT * FROM clientes_filesystem, clientes_users WHERE clientes_filesystem.owner_id = clientes_users.id ORDER BY name";
		$result = mysql_query($sql);
		//table files
		echo "<table class='table table-bordered table-hover'>
			<tbody>";
		while($row = mysql_fetch_array($result))
			{ $id = $row['clientes_filesystem.id'];
			  $name_owner = $row['name'];
			  $file = $row['file'];
			  echo "<tr>
						<td>".$name_owner."</td>
						<td><a onclick=\"window.open('download.php?file=data/".$file."', 'download', 'status=0');\">".$file."</a></td><td>" . filesize("data/".$file) . " bytes</td>
				        <td><a class='btn btn-danger' onclick='borra_archivo(\"".$id."\",\"".$file."\");' >Borrar <i class='icon-fire icon-white'></i></td>
				    </tr>";
		 	}
		
	}else{
//find the BD filesystem
	$sql = "SELECT * FROM clientes_filesystem WHERE owner_id = '$_POST[owner_id]'";
	$result = mysql_query($sql);
	//table files
		echo "<table class='table table-bordered table-hover'>
				<tbody>";
		while($row = mysql_fetch_array($result))
		{ $id = $row['id'];
		  $file = $row['file'];
		  echo "<tr><td><a onclick=\"window.open('download.php?file=data/".$file."', 'download', 'status=0');\">".$file."</a></td><td>" . filesize("data/".$file) . " bytes</td>
			          <td><a class='btn btn-danger' onclick='borra_archivo(\"".$id."\",\"".$file."\");' >Borrar <i class='icon-fire icon-white'></i></td>
			      </tr>";
	 	}

	}
	echo "</tbody>
		</table>";
	
	/** NO BD FILESYSTEM	
	$dir    = 'data';
	$files = scandir($dir);
	echo "<table class='table table-bordered table-hover'>
			<tbody>";
	foreach ($files as $value) {
		$total += filesize('data/'.$value);
		echo "<tr><td><a onclick='down_load(\"".$value."\");'>".$value."</a></td><td>" . filesize("data/".$value) . " bytes</td>
		          <td><a class='btn btn-danger' onclick='borra_archivo(\"".$value."\");' >Borrar <i class='icon-fire icon-white'></i></td>
		      </tr>";
		}
	echo "</tbody>
		</table>";
echo $total; 
	**/

}else {
	echo "Not allowed";
	}
?>