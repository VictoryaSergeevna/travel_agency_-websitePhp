<?php
$_GET['page'] = 2;
include_once('json.php');
?>
	<form action="index.php?page=2" method="POST">
	<h1>Комментарии</h1> 
	<input type="submit" name="json" value="Отправить json" class="btn btn-outline-success my-2 my-sm-0"> 
</form>
<?php
json_query();
?>
<a href="index.php">Назад</a>