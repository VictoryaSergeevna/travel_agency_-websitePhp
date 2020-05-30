<div class="form-inline">
<select name="idCity"  class="form-control mx-sm-3" onchange="showHotels(this.value)">	
<?php
include_once('functions.php');
$link=connect();
$idCountry=$_GET['id'];
$query ='SELECT * FROM  cities where  countryid='.$idCountry;
$res = mysqli_query ($link,$query);
for ($c=0; $c<mysqli_num_rows($res); $c++)
{
$f = mysqli_fetch_array($res);
echo '<option  class="form-control  mr-sm-2" value="'.$f[0].'">'.$f[1].'</option>'; 
}
mysqli_free_result($res);
?>
 </select>
</div>
<style type="text/css">
div {
    margin-bottom: 20px;
  }
  
  
</style>
