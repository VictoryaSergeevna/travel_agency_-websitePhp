<?php
include_once('functions.php');
$link=connect();
$log=$_POST['log'];
$query ='SELECT * FROM  users';
$res = mysqli_query ($link,$query);
for ($c=0; $c<mysqli_num_rows($res); $c++)
{
$f = mysqli_fetch_array($res);
$user = $f[1];
if(substr($user,0,strlen($log))===$log){
	echo "<h3><font color=red font face='arial' size='20pt'> Логин с таким именем уже занят!</font></h3>";
}
else
 echo "";
}
mysqli_free_result($res);
?>