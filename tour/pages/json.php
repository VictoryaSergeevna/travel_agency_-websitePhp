<?php
function json_query(){
/*include_once('functions.php');*/
include_once('classes.php');
/*$link=connect();*/
 if(isset($_POST['json'])){ 
 $db = new Database();
 /*$db = database::createDatabase("travels");*/
 $db->connect();
 $tours =array();  	
 $query= 'SELECT   ho.hotel,ho.stars, ho.cost,  co.country, ci.city
    from cities ci, hotels ho, countries co WHERE ho.cityid=ci.id and ho.countryid=co.id'; 
 $res = $db->query($query); 
/*$res=mysqli_query($link, $query);*/
while ($f = $res->fetch_assoc())
/*while($f=mysqli_fetch_array($res))*/
{
$tour = new Tour();
$country=$f['country'];
$city=$f['city'];
$hotel=$f['hotel'];
$starts=$f['stars'];
$cost=$f['cost'];
$tour->country=$country;
$tour->city=$city;
$tour->hotel=$hotel;
$tour->stars=$stars;
$tour->cost=$cost;
$tours[]=$tour;      
}
$jstour=json_encode($tours);
file_put_contents('jstour.txt',$jstour);
}
}
?>
