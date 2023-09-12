<!DOCTYPe html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<title> Главная страница </title>
</head>
<body>
<h1> Фотографии </h1>
<div class="main">
<h2>Чтобы ваше фото появилось здесь - отправьте нам его на почту, указанную в контактах!:)</h2>
<?php
include ("base.php");
$result=pg_query($link, 'SELECT name_auth, url, name, brand, "Model".id_model from "Photo", "Model" where "Photo".id_model="Model".id_model');
	while ($row = pg_fetch_row($result)) {
		echo '<a href="car_model.php?id='.$row[4].'">'."<img src='/photo/user/".$row[1]."' width='900' 
			height='600'></a>";
		echo "<h4>Автор: ".$row[0]."<br>";
		echo '<a href="car_model.php?id='.$row[4].'">'."Модель: ".$row[3]." ".$row[2].'</a></h4><br><br><br>';
	}
?>
</div>
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
</body>
</html>