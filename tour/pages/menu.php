<?php
$page=$_GET['page'];
?>
   <ul class="nav nav-pills">
  <li class="nav-item">
    <a <?php echo($page==1)?"class='nav-link active'":"class='nav-link'"?> href="index.php?page=1">Tours</a>
  </li>
  <li class="nav-item">
    <a <?php echo($page==2)?"class='nav-link active'":"class='nav-link'"?> href="index.php?page=2">Comments</a>
  </li>
  <li class="nav-item">
    <a <?php echo($page==3)?"class='nav-link active'":"class='nav-link'"?> href="index.php?page=3">Registration</a>
  </li>  
  <li class="nav-item">
    <a <?php echo($page==4)?"class='nav-link active'":"class='nav-link'"?> href="index.php?page=4">Admin Forms</a>
  </li>
 <?php
 if(isset($_SESSION['registered_admin'])){
  if($page==6)
    $c='active';
  else
    $c='';
  echo '<li class="nav-item"><a class="nav-link '.$c.'"href="index.php?page=6">Private</a></li>';
 }
  ?>
</ul>


<style type="text/css">
  a:hover{
    background-color: lightgrey;
  }
  ul{    
    height: 50px;    
   /*  padding: 5px;    */
  }
  li{
    font-weight: bold;
    font-size:20px;
    width: 160px;
    margin: 10px;
  }

</style>