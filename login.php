<?php
if (!$_POST['u']==''){
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
//find the user	
	$sql="SELECT * FROM clientes_users WHERE name ='$_POST[u]' AND pass = '$_POST[p]'";
 	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{ $id = $row['id'];
	  $name = $row['name'];
 	}
	if ($id <> ''){
		echo "
				<script>
					var owner_id = ".$id.";
					var user_name = '".$name."';
					var logued = 'true';
					//alert(user_name +' '+ logued);
					$('#login').hide();
					scan_data();
					$('#logout_container').show();
					$('#logued_cliente').show();
					$('#head_clientes').empty();
					$('#head_clientes').append(user_name);
				</script>"; 
		}else{
			echo "
					<script>
						alert('Bad credentials');
						//$('#login').effect(shake, options, 500, callback );
					</script>";
		}
	}else {
		echo "Error: you don't want to do that";
	}

?>

