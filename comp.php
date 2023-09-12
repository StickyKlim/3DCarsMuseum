<!DOCTYPe html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<title> Выставка </title>
</head>
<body>
<h1> Добро пожаловать! </h1>
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
<?php
include ("base.php");
$result=pg_query($link, 'SELECT * from "Compilation", "Model" where "Compilation".id_model="Model".id_model and region='."'".$_GET['name']."'");
	while ($row = pg_fetch_row($result)) {
		echo '<h2><a href="car_model.php?id='.$row[1].'">'."Модель: ".$row[4]." ".$row[5].'</a></h2><br><br>';
		echo '<a href="car_model.php?id='.$row[1].'">'."<img src='/photo/comp/".$row[2]."' width='900' 
   height='600'></a><br><br><br>";
	}
?>
</div>
</body>
</html>