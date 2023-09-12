<!DOCTYPe html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<title> Главная страница </title>
</head>
<body>
<h1> Привет, администратор! </h1>
<div class="main">
<div class="admin">
<h3><?php
session_start();
if(isset($_SESSION['login'])) {
    echo "Ваш логин: <b>". $_SESSION['login']."</b><br><br>";
    echo "<a href='exit.php'>Выход</a>";
    unset($_SESSION['error']);
}
?></h3></div>
<div class="but">
<form action="add_model.php">
<input type="submit" name="button" value="Добавить модель">
</form>
<form action="add_photo.php">
<input type="submit" name="button" value="Добавить фото">
</form>
<form action="add_user.php">
<input type="submit" name="button" value="Добавить Админа">
</form>
</div>
<br><br><br><br> <?php
include ("base.php");
$brand=pg_query($link, 'SELECT distinct(brand) FROM "Model"');
	while ($row = pg_fetch_row($brand)) {
		echo '<div class="carbox"><li>'.$row[0].'</li><ul>';
		$res=pg_query($link, 'SELECT id_model, name FROM "Model" where brand='."'".$row[0]."'");
		while ($spisok = pg_fetch_row($res)) {
			echo '<li><a href="car_admin.php?id='.$spisok[0].'">'.$spisok[1].'</a></li>';
		}
		echo '</ul></div>';
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