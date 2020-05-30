 <?php
$_GET['page'] = 4;
if(isset($_SESSION['registered_admin']))
{
$link=connect();
?>

<div class="row">
<div class="col-sm-6 col-md-6 col-lg-6 left">
<form action="index.php?page=4" method="POST">
<table class="table table-striped">  
<thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Страна</th>      
      <th scope="col">Удаление</th>
    </tr>    
  </thead>
  <tbody>
  <?php
   $q = mysqli_query ($link,"SELECT * FROM countries order by id");
for ($c=0; $c<mysqli_num_rows($q); $c++)
{
echo "<tr>";
$f = mysqli_fetch_array($q);
echo "<td scope='row'>$f[id]</td><td scope='row'>$f[country]</td>";
echo "<td scope='row'><input type='checkbox' name='cb".$f[0]."'></td>";
echo "</tr>";
}
 ?>    
  </tbody>
</table>
<div class="form-inline float-left">	
<input type="text" class="form-control  mr-sm-2"   name="country" placeholder="Country">	
<input type="submit" name="add_country" value="Добавить" class="btn btn-outline-success my-2 my-sm-0">
<input type="submit" name="del_country" value="Удалить"class="btn btn-outline-success my-2 my-sm-0">
</div>
</form>
<?php
mysqli_free_result($q);
if(isset($_POST['add_country']))
{
 $country=$_POST['country'];
  $query ='INSERT INTO countries(country) VALUES("'.$country.'")';
  $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
 if($result){	
	echo '<script>window.location=document.URL;</script>';	
  }
}
if(isset($_POST['del_country']))
{
	foreach ($_POST as $key => $value) {
		if(substr($key, 0,2)=='cb')
		{
			$id=substr($key,2);
			$del='DELETE FROM countries WHERE id='.$id;
            $result=mysqli_query ($link,$del)or die("Ошибка " . mysqli_error($link));
		}
	}
	echo '<script>window.location=document.URL;</script>';	
}
?>
</div>

<div class="col-sm-6 col-md-6 col-lg-6 right">
<form action="index.php?page=4" method="POST">
<table class="table table-striped">  
<thead>
    <tr>
      <th scope="col">Id</th>
       <th scope="col">Город</th>  
      <th scope="col">Страна</th>      
      <th scope="col">Удаление</th>
    </tr>    
  </thead>
  <tbody>
<?php
 $q = mysqli_query ($link,"SELECT C.id, C.city, Cn.country FROM cities C, countries Cn where Cn.id=C.countryid order by id");
for ($c=0; $c<mysqli_num_rows($q); $c++)
{
echo "<tr>";
$f = mysqli_fetch_array($q);
echo "<td scope='row'>".$f[0]."</td><td scope='row'>".$f[1]."</td><td scope='row'>".$f[2]."</td>";
echo "<td scope='row'><input type='checkbox' name='cb".$f[0]."'></td>";
echo "</tr>";
}
 ?>  
 </tbody>
</table>
<?php  mysqli_free_result($q); ?>
<div class="form-inline float-left">
<select name="selectCountry" class="form-control  mr-sm-2">	
<?php
$q = mysqli_query ($link,"SELECT * FROM countries");
for ($c=0; $c<mysqli_num_rows($q); $c++)
{
$f = mysqli_fetch_array($q);
echo "<option  class='form-control  mr-sm-2' value=".$f[0].">".$f[1]."</option>"; 
}
?>
 </select>
<input type="text" class="form-control  mr-sm-2"   name="city" placeholder="City">	
<input type="submit" name="add_city" value="Добавить" class="btn btn-outline-success my-2 my-sm-0">
<input type="submit" name="del_city" value="Удалить"class="btn btn-outline-success my-2 my-sm-0">
</div> 
</form>
<?php
mysqli_free_result($q);
if(isset($_POST['add_city']))
{
 $city=$_POST['city']; 
 $selectCountry=$_POST['selectCountry']; 
  $query ='INSERT INTO cities(city,countryid) VALUES("'.$city.'",'.$selectCountry.')';
  $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
 if($result){	
	echo '<script>window.location=document.URL;</script>';	
  }
}
if(isset($_POST['del_city']))
{
	foreach ($_POST as $key => $value) {
		if(substr($key, 0,2)=='cb')
		{
			$id=substr($key,2);
			$del='DELETE FROM cities WHERE id='.$id;
            $result=mysqli_query ($link,$del)or die("Ошибка " . mysqli_error($link));
		}
	}
	echo '<script>window.location=document.URL;</script>';	
} 
?>
</div>
</div>
<hr/>
<div class="row">
<div class=" col-sm-6 col-md-6 col-lg-6 left ">
 <form action="index.php?page=4" method="post" class="input-group" id="formhotel">
    <?php    
    $sel='SELECT ci.id, ci.city, ho.id, ho.hotel, ho.cityid, ho.countryid, ho.stars, ho.info, co.id, co.country
    from cities ci, hotels ho, countries co WHERE ho.cityid=ci.id and ho.countryid=co.id';
    $res=mysqli_query($link, $sel);
   ?>
   <table class="table table-striped">
    <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Город-Страна</th>  
      <th scope="col">Отель</th>     
      <th scope="col">*</th>    
      <th scope="col">Удаление</th>
    </tr>    
  </thead>
  <tbody>
<?php	
   while ($row=mysqli_fetch_array($res))
    {
      echo '<tr>';
      echo '<td>'.$row[2].'</td>';
      echo '<td>'.$row[1]."-".$row[9].'</td>';
      echo '<td>'.$row[3].'</td>';
      echo '<td>'.$row[6].'</td>';
      echo '<td><input type="checkbox" name="hb'.$row[2].'"></td>';
      echo '</tr>';
    }
    ?>
  </tbody>
 </table>  
    <?php  mysqli_free_result($res); ?>
 <div class="form-inline float-left">
 <select name="hcity" class="form-control  mr-sm-2">
    <?php   
    $sel='SELECT ci.id, ci.city, co.country, co.id 
    from countries co, cities ci
    WHERE ci.countryid=co.id';
    $res=mysqli_query($link, $sel);
    $csel=array();
    while ($row=mysqli_fetch_array($res))
    {
      echo '<option value="'.$row[0].'">'.$row[1]." : ".$row[2].'</option>';
    $csel[$row[0]]=$row[3];
    } 
    mysqli_free_result($res);   
    ?>
 </select>
 <input type="text" class="form-control  mr-sm-2"   name="hotel" placeholder="Hotel">
<input type="text" class="form-control  mr-sm-2"   name="cost" placeholder="Cost">
<p>&nbsp;&nbsp;Stars:
<input type="number" class="form-control  mr-sm-2"   name="stars" min="1" max="5"></p>
<textarea name="info" class="form-control  mr-sm-2" placeholder="Description" maxlength="200"></textarea>
<input type="submit" name="add_hotel" value="Добавить" class="btn btn-outline-success my-2 my-sm-0">
<input type="submit" name="del_hotel" value="Удалить"class="btn btn-outline-success my-2 my-sm-0">
</div>
</form>
<?php  
 if(isset($_POST['add_hotel'])){
      $hotel=trim(htmlspecialchars($_POST['hotel']));
      $cost=intval(trim(htmlspecialchars($_POST['cost'])));
      $stars=intval($_POST['stars']);
      $info=trim(htmlspecialchars($_POST['info']));
      if ($hotel==""||$cost==""||$stars=="") exit();
      $cityid=$_POST['hcity'];
      $countryid=$csel[$cityid];
      $ins='insert into hotels (hotel,cityid,countryid,stars,cost,info) values("'.$hotel.'",'.$cityid; 
      $ins.=",".$countryid.','.$stars.','.$cost.',"'.$info;
      $ins.='")';
      mysqli_query($link, $ins);
      echo "<script>";
      echo "window.location=document.URL;";
      echo "</script>";
    }
    if(isset($_POST['del_hotel'])){
      foreach ($_POST as $key => $value) {
		if(substr($key, 0,2)=='cb')
		{
			$id=substr($key,2);
			$del='DELETE FROM hotels WHERE id='.$id;
            $result=mysqli_query ($link,$del)or die("Ошибка " . mysqli_error($link));
            if ($err){
          echo 'Error code:'.$err.'<br>';
          exit();
        }
		}
	}
	echo '<script>window.location=document.URL;</script>';
    }
    ?>
</div>

<div class=" col-sm-6 col-md-6 col-lg-6 right ">
<form action="index.php?page=4" method="POST" enctype='multipart/form-data'>
<div class="form-group">
<select name="hotelid" class="form-control  mr-sm-2" >	
<?php
$q = mysqli_query ($link,"SELECT H.id, H.hotel, C.id, C.city, Cn.id, Cn.country  FROM hotels as H, cities as C, countries as Cn  where H.cityid= C.id and H.countryid=Cn.id order by H.id");
$csel=array();
for ($c=0; $c<mysqli_num_rows($q); $c++)
{
$f = mysqli_fetch_array($q);
echo '<option  class="form-control  mr-sm-2" value="'.$f[0].'">'.$f[1]." ".$f[3]." ".$f[5].'</option>'; 
$csel[$f[0]]=$f[2];
$csel[$f[0]]=$f[4];
}
?>
 </select>
 <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
 <input type="file" name="file[]" class="form-control-file" multiple accept="images/*"><br>
 <input type="submit" name="add_file" value="Загрузить" class="btn btn-outline-success my-2 my-sm-0">
</div>
<?php
if(isset($_POST['add_file'])){
$hotelid=$_POST['hotelid'];
$cityid=$csel[$hotelid];
$countryid=$csel[$hotelid];
foreach($_FILES['file']['name'] as $k => $v){
if ($_FILES['file']['error'][$k]!=0)
   { 

   	echo '<script>alert("Upload file error:'.$v.'")</script>';
         continue;
     }

   	if(move_uploaded_file($_FILES['file']['tmp_name'][$k], 'images/'.$v)){
  $ins='insert into images(hotelid,imagepath) values('.$hotelid.',"images/'.$v.'")';
       mysqli_query($link,$ins);
      }
   }

 } 
?>
</div>
</div>
 </form> 

<?php
mysqli_free_result($q); 
}
else
   {
	echo "<h3><font color=red font face='arial' size='20pt'>For admin Only!</font></h3>";
	exit();
	}

	
 ?>
 <a href="index.php">Назад</a>

 <style type="text/css">
tr{
	text-align: center;
	font-size: 18px;
	font-family: sans-serif;
}

th {
	text-align: center;
	color:#ffe;
	background:rgba(114, 244, 114, 0.8);
	font-family: Arial, Helvetica, sans-serif;
	font-size:18px;
  }
td:first-child{
	font-weight: bold;

}
</style>