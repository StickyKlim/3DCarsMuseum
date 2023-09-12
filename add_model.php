<!DOCTYPe html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<title> Добавление данных </title>
</head>
<body>
<h1> Добавить модель </h1>
<ul class="menu">
    <li><a href="index.php">Главная страница</a></li>
    <li><a href="car_list.php">Экспонаты</a> </li>
    <li><a>Выставка</a></li>
	<ul>
<?php
include ("base.php");
$result=pg_query($link, 'select distinct(region) from "Compilation"');
	while ($row = pg_fetch_row($result)) {
			echo '<li><a href="comp.php?name='.$row[0].'">'.$row[0].'</a></li>';
		}
?>
	</ul>
    <li><a href="photo.php">Фотографии</a></li>
	<li><a href="cont.php">Контакты</a></li>
	<li><a href="adminin.php">Администрация</a></li>
</ul>
<div class="main">
<form action="add_model.php" method="GET">
	<div class="table1">
	<h3>Таблица: Модель</h3>
	<textarea name="name" id="name" placeholder="Модель"></textarea><br>
	<textarea name="brand" id="brand" placeholder="Марка"></textarea><br>
	<textarea name="descript" id="descript" placeholder="Описание"></textarea><br><br><br>
	
	<h3>Таблица: Выставка</h3>
	<select name="region">
		<option value="Asia">Asia</option>
		<option value="Europe">Europe</option>
		<option value="North America">North America</option>
	</select><br><br>
	<textarea name="img" id="brand" placeholder="model.jpg"></textarea><br><br><br>
	</div>
	
	<div class="table2">
	<h3>Таблица: История</h3>
	<textarea name="owner" id="owner" placeholder="Владелец"></textarea><br>
	<textarea name="history" id="history" placeholder="История"></textarea><br>
	<textarea name="years" id="years">1990-01-01</textarea><br>
	<textarea name="yeare" id="yeare">1991-01-01</textarea><br><br><br>
	
	<h3>Таблица: Данные</h3>
	<textarea name="3d_mod" id="name" placeholder="model_name/scene.gltf">/models/</textarea><br>
	<textarea name="x_size" id="x_size" placeholder="Размер Х"></textarea><br>
	<textarea name="y_size" id="y_size" placeholder="Размер Y"></textarea><br>
	<textarea name="z_size" id="z_size" placeholder="Размер Z"></textarea><br><br><br>
	</div>
	<div class="table1">
	<div class="but">
	<input type="submit" name="add" value="Добавить"><br>
	</div>
	</div>
</form>
<?php
include ("base.php");
	$id_res=pg_query($link, 'Select max(id_model) from "Model"');
	while ($id_row = pg_fetch_row($id_res)) {
		global $id_max;
		$id_max=$id_row[0]+1;
	}
    if(isset($_GET['add'])){
		$model=pg_query($link, 'INSERT INTO "Model" VALUES ('.$id_max.",'".$_GET['name']."','".$_GET['brand']."','".$_GET['descript']."');");
		$comp=pg_query($link, 'INSERT INTO "Compilation" VALUES ('."'".$_GET['region']."',".$id_max.",'".$_GET['img']."');");
		$history=pg_query($link, 'INSERT INTO "History" VALUES ('.$id_max.",'".$_GET['owner']."','".$_GET['history']."','".$_GET['years']."','".$_GET['yeare']."');");
		$set=pg_query($link, 'INSERT INTO "Settings" VALUES ('.$id_max.",'".$_GET['3d_mod']."',".$_GET['x_size'].",".$_GET['y_size'].",".$_GET['z_size'].");");
	}
?>
</div>
</body>
</html>