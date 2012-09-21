<?php
echo $_POST['filesystem'];
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
?>