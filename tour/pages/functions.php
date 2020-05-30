<?php
function connect()
{
$host='localhost';
$user='root';
$pass='';
$dbname='travels';
$link=mysqli_connect($host,$user,$pass) or die('connection error');
  mysqli_select_db($link,$dbname) or die('DB open error');
  mysqli_query($link,"set names 'utf8'");
  return $link;
}

function login($login,$pass)
{ 

	$link = connect();
	$query="SELECT * FROM users WHERE login ='$login' AND pass='$pass'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));    

 if(mysqli_num_rows($result)>0)
    {  

    $row = mysqli_fetch_row($result);
    $roleid=1;
    if($roleid==$row[4])
    {   
    $_SESSION['registered_admin'] = $login;         
    return true;
    }
    else{
    $_SESSION['registered_user'] = $login;
    return true;
        }
    }

 else 
    {
     echo ' <script>window.location = "index.php?page=3";</script>';
     return false;
     }   

}
   

?>