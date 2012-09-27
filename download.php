<?php

$file = $_REQUEST['file'];
header('Content-Description: File Transfer');
header("application/octet-stream");
header("Content-disposition: attachment; filename= ".$file."");
readfile($file);

?>