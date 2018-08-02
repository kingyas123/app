<?php
require "con1.php";
$v=isset($_POST['token'])?$_POST['token']:'';
$s=isset($_POST['s'])?$_POST['s']:'';
$s1=isset($_POST['spin'])?$_POST['spin']:'';

$sql="insert into token_data values('$v','$s','$s1');";
$d=mysqli_query($con,$sql);

if($d)
	echo "insert successfully";
        else
	echo "failed";

mysqli_close($con);

?>