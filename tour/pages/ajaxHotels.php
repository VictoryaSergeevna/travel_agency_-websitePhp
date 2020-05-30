<table class="table table-striped">  
<thead>
  <tr>
    <th scope="col">Hotel</th>
    <th scope="col">Country</th>  
    <th scope="col">City</th>     
    <th scope="col">Price</th>    
    <th scope="col">Starts</th>
    <th scope="col">link</th>
  </tr>    
</thead>
<tbody>
<?php
include_once('functions.php');
$link=connect();
$idCity=$_GET['id'];
 $query='SELECT ci.id, ci.city, ho.id, ho.hotel, ho.cityid, ho.countryid, ho.stars, ho.cost, co.id, co.country
    from cities ci, hotels ho, countries co WHERE ho.cityid=ci.id and ho.countryid=co.id and cityid='.$idCity;

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));  

while ($f=mysqli_fetch_array($result))
    
{
echo '<tr>';
echo '<td scope="row">'.$f[3].'</td><td scope="row">'.$f[9].'</td><td scope="row">'.$f[1].'</td><td scope="row">'.$f[7].'</td><td scope="row">'.$f[6].'</td><td scope="row"><a href="pages/hotel_info.php?hotel='.$f[2].'"target="_ blank">more info</a></td>';
echo '</tr>';
}
mysqli_free_result($result);
 ?>  
 </tbody>
</table>