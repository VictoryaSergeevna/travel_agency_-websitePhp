<?php
$_GET['page'] = 6; 
/*include_once('upload.php');*/
if(isset($_SESSION['registered_admin']))
{
$link=connect();
?>
<form action="index.php?page=6" method="POST" enctype='multipart/form-data'>	
<div class="form-inline">
<select name="userid" class="form-control  mr-sm-2">
<?php
$q='SELECT * FROM users where roleid=2 order by login';
$res = mysqli_query ($link,$q);
for ($c=0; $c<mysqli_num_rows($res); $c++)
{
$f = mysqli_fetch_array($res);
echo '<option  class="form-control  mr-sm-2" value="'.$f[0].'">'.$f[1].'</option>'; 
}
?>
 </select>
 <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
 <input type="file" name="file" class="form-control-file"   accept="images/*"><br>
 <input type="submit" name="add_file" value="Загрузить" class="btn btn-outline-success my-2 my-sm-0">
</div>
</form> 
<?php
if(isset($_POST['add_file'])){
$userid=$_POST['userid'];
 $fn=$_FILES['file']['tmp_name'];
 $file=fopen($fn,'rb');
 $img=fread($file, filesize($fn));
 fclose($file);
$img=mysqli_real_escape_string($link,$img);
$upd='update users set avatar="'.$img.'", roleid=1 where id='.$userid;
mysqli_query($link, $upd);

$sel='SELECT * from users where roleid=1 order by login';
$res=mysqli_query($link,$sel);
echo '<table class="table table-striped">';
while($row=mysqli_fetch_array($res)){
echo '<tr>';
echo '<td>'.$row[0].'</td>';
echo '<td>'.$row[1].'</td>';
echo '<td>'.$row[3].'</td>';
$img=base64_encode($row[6]);
echo '<td><img height="100px"
src="data:image/jpeg; base64,'.$img.'"/></td>';
}
mysqli_free_result($res);
echo '</table>';

}
   ?>
</form>
<?php
 } 
 ?>



 