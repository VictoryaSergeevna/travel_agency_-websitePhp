<?php
$_GET['page'] = 1;
$link=connect();
?>
<h1>Выберите Туры</h1>
<!-- <form action="index.php?page=1" method="POST" class="form-inline">  -->
<div class="form-inline">
<select id="idCountry"  onchange="showCities(this.value)" class="form-control mx-sm-3">	
<?php
$q = mysqli_query ($link,"SELECT * FROM countries");
for ($c=0; $c<mysqli_num_rows($q); $c++)
{
$f = mysqli_fetch_array($q);
echo'<option  class="form-control  mr-sm-2" value='.$f[0].'>'.$f[1].'</option>'; 
}
mysqli_free_result($q); 
?>
 </select>
</div>

 <div id="cityid">
 </div>
 <div id="hotels">
 </div>

 
 <a href="index.php">Назад</a>

 <script type="text/javascript"> 
 function showCities(value)	
 {
 	if (value=='0'){
 		document.document.getElementById("cityid").innerHTML="";
 	}

 	if(window.XMLHttpRequest){
 		ao=new XMLHttpRequest();
 	}

 	else{
 		ao=new ActiveXObject('Microsoft.XMLHTTP');
 	}
 	ao.onreadystatechange=function(){
 if(ao.readyState == 4 || ao.status == 200)
 {
 resp = ao.responseText;
 document.getElementById("cityid").innerHTML = resp;
 
 }
 
 }
 ao.open("GET", "pages/ajaxCities.php?id="+value, true); 
 ao.send(null);
}
 



  function showHotels(value)	
 {
 	if (value=='0'){
 		document.document.getElementById("hotels").innerHTML="";
 	}

 	if(window.XMLHttpRequest){
 		ao=new XMLHttpRequest();
 	}
 	
 	else{
 		ao=new ActiveXObject('Microsoft.XMLHTTP');
 	}
 	ao.onreadystatechange=function(){
 if(ao.readyState == 4 || ao.status == 200)
 {
 resp = ao.responseText;
 document.getElementById("hotels").innerHTML = resp;
 
 }
 
 }
 ao.open("GET", "pages/ajaxHotels.php?id="+value, true); 
 ao.send(null);
}	
 </script>
 

