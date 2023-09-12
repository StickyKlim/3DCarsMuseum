<!DOCTYPe html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<title> Добавление данных </title>
</head>
<body>
<h1> Добавить Фото </h1>
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
<form action="add_photo.php" method="GET">
	<h3>Таблица: Модель</h3>
	<select name="name">
	<?php
	include ("base.php");
	$result=pg_query($link, 'SELECT id_model, name FROM "Model"');
		while ($row = pg_fetch_row($result)) {
				echo '<option value="'.$row[0].'">'.$row[1].'</option>';
		}
	?>
	</select><br><br>
	<textarea name="auth" id="auth" placeholder="Автор"></textarea><br>
	<textarea name="url" id="url" placeholder="model.jpg"></textarea><br><br><br>
	<div class="add_but">
	<input type="submit" name="add" value="Добавить"><br>
	</div>
</form>
<?php
include ("base.php");
	if(isset($_GET['add'])){
	$model=pg_query($link, 'INSERT INTO "Photo" VALUES ('.$_GET['name'].",'".$_GET['auth']."','".$_GET['url']."', DEFAULT );");
	}
?>
</div>
</body>
</html>