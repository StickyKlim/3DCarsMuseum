<!DOCTYPe html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<title> Главная страница </title>
</head>
<body>
<h1> Добро пожаловать! </h1>
<div class="main">
<div class="admin">
    <form action="check.php" method="POST">
        Пользователь:
        <input type="text" size="20" name="login"><br><br>
        Пароль:
        <input type="password" size="20" name="password"><br><br>
        <button type="submit" name="but">Войти</button>
    </form>
</div>
</div>
<ul class="menu">
    <li><a href="index.html">Главная страница</a></li>
    <li><a href="car_list.php">Экспонаты</a> </li>
    <li><a>Выставка</a></li>
	<ul>
        <li><a href="eu.php">Европа</a></li>
		<li><a href="asia.php">Азия</a></li>
		<li><a href="na.php">Америка</a></li>
	</ul>
    <li><a href="photo.php">Фотографии</a></li>
	<li><a href="cont.php">Контакты</a></li>
	<li><a href="adminin.php">Администрация</a></li>
</ul>
</body>
</html>