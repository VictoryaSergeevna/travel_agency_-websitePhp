 <?php  
if($_SESSION['registered_user'])
{
echo '<form action="index.php';
if(isset($_GET['page'])) echo '?page='.$_GET['page'].'" ';
echo 'class="form-inline float-right" method="post">';
echo '<h4>Здраствуйте пользователь: <span>'.$_SESSION['registered_user'].'!</span>&nbsp;';
echo '<input type="submit" value="Logout" id="ex" name="ex" class="btn btn-default btn-xs"></h4>';
echo '</form>';
if($_POST['ex'])
{
	unset($_SESSION['registered_user']);
	echo ' <script>window.location.reload()</script>';

}
}
else if($_SESSION['registered_admin'])
{
	echo '<form action="index.php';
if(isset($_GET['page'])) echo '?page='.$_GET['page'].'" ';
echo 'class="form-inline float-right" method="post">';
echo '<h4>Здраствуйте админ: <span>'.$_SESSION['registered_admin'].'!</span>&nbsp;';
echo '<input type="submit" value="Logout" id="ex" name="ex" class="btn btn-default btn-xs"></h4>';
echo '</form>';
if($_POST['ex'])
{
	unset($_SESSION['registered_admin']);
	echo ' <script>window.location.reload()</script>';

}
}


else
{
	if(!isset($_POST['input']))
	{
	   	
   echo '<form action="index.php';
  if(isset($_GET['page'])) echo '?page='.$_GET['page'].'" ';
echo 'class="form-inline float-right" method="post">';
echo '<input class="form-control mr-sm-2" type="text" placeholder="Введите логин"  name="auth_log">
      <input class="form-control mr-sm-2" type="text" placeholder="Введите пароль"  name="auth_pas">
      <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="input">
    </form>';
    
	}
   else
	{	
	$login=$_POST['auth_log'];
    $pass =$_POST['auth_pas'];
    if(login($login,$pass)==true){
	  echo ' <script>window.location.reload()</script>';
	 }
		
	}
}
?>
 
<style type="text/css">
	form {
		margin-bottom:10px;
		margin-top:30px;
	}
</style>



