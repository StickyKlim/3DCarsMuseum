<!DOCTYPe html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<title> Добавление данных </title>
</head>
<body>
<h1> Добавить Админа </h1>
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
<form action="add_user.php" method="GET">
	<h3>Таблица: Модель</h3>
	<textarea name="login" id="login" placeholder="Логин"></textarea><br>
	<textarea name="pass" id="pass" placeholder="Пароль"></textarea><br>
	<div class="add_but">
	<input type="submit" name="add" value="Добавить"><br>
	</div>
</form>
<?php
include ("base.php");
	$id_res=pg_query($link, 'SELECT max(id) from "Users"');
	while ($id_row = pg_fetch_row($id_res)) {
		global $id_max;
		$id_max=$id_row[0]+1;
	}
    if(isset($_GET['add'])){
		$model=pg_query($link, 'INSERT INTO "Users" VALUES ('.$id_max.",'".$_GET['login']."','".$_GET['pass']."');");
	}
?>
</div>
</body>
</html>