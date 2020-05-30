<?php
/*include_once('functions.php');*/
$_GET['page'] = 3;
$link=connect();
?>
	<form action="index.php?page=3" method="POST">
	<h1>Регестрация</h1> 
 <div class="form-group">
    <label for="InputLogin">Введите логин:</label>
    <input type="text" class="form-control" placeholder="Логин должен содержать 3-30 символов" name="login" id="logintext" oninput="checkLogin()" required> 
    <div id="res"></div>   
  </div>
  <div class="form-group">
    <label for="InputPassword">Пароль:</label>
    <input type="password" class="form-control" id="InputPassword" placeholder="Введите пароль" name="pass"  required>
  </div>
  <div class="form-group">
    <label for="InputRepeat_Pas">Повторите пароль:</label>
    <input type="password" class="form-control" id="InputRepeat_Pas" placeholder="Пароли должны совпадать" name="repeat_pas" required>
  </div>
   <div class="form-group">
    <label for="InputEmail">Введите email:</label>
    <input type="email" class="form-control" id="InputEmail" placeholder="name@example.com" name="email" aria-describedby="emailHelp" required>      
  </div>  
  <button type="submit" name="save" class="btn btn-primary" >Сохранить</button>
</form>

<?php
if(isset($_POST['save']))
{  
  $login=$_POST['login'];
  $pass =$_POST['pass'];
  $repeat_pas =$_POST['repeat_pas'];
  $email=$_POST['email'];  
if($pass == $repeat_pas)
{
	if (strlen($login) < 3 or strlen($login) > 30 or strlen($pass) < 3 or strlen($pass) > 30)
          {
   echo "<h3><font color=red font face='arial' size='20pt'>Логин и пароль должен состоять не менее чем из 3 символов и не более чем из 30!</font></h3>";  
        }

    
  $query ='INSERT INTO users(login,pass,email,roleid) VALUES("'.$login.'","'.$pass.'","'.$email.'",2)';
  $result = mysqli_query($link, $query);
   $err=mysqli_error($link); 
   if($err)
   {
   if($err==1062){
   	echo "<h3><font color=red font face='arial' size='20pt'> Логин с таким именем уже занят!</font></h3>";
   }
   else
   {
  	echo "<h3><font color=red font face='arial' size='20pt'> ".$err."</font></h3>";
   }}
    else
    {
      echo "<h3><font color=green font face='arial' size='20pt'>Новый пользователь добавлен!</font></h3>";
    }
    mysqli_close($link);
}
  	
else
{
   echo "<h3><font color=red font face='arial' size='20pt'>Пароли не совпадают!</font></h3>";
}
}
?>

<script type="text/javascript">

 function checkLogin() 
 {
 ao=new XMLHttpRequest();
 /* if(window.XMLHttpRequest){
    ao=new XMLHttpRequest();
  }
  
  else{
    ao=new ActiveXObject('Microsoft.XMLHTTP');
  }*/

 if(ao.readyState == 4 || ao.readyState == 0)
 {
  log=document.getElementById("logintext").value;
  ao.open("POST","pages/ajaxRegist.php", true);
  ao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
ao.onreadystatechange = function()
{
if(ao.readyState == 4 && ao.status == 200)
{
resp = ao.responseText;
document.getElementById("res").innerHTML = resp;
}
 
} 
 ao.send("log="+log);
} 
}
</script>