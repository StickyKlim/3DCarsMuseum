<!DOCTYPe html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Project </title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<script src="threejs.org/build/three.js"></script>
	<script src="threejs.org/examples/js/loaders/GLTFLoader.js"></script>
	<script src="threejs.org/examples/js/controls/OrbitControls.js"></script>
<?php 
include ("base.php");
if(isset($_GET['id'])){
	$result=pg_query($link, 'SELECT brand, name FROM "Model" where id_model='."'".$_GET['id']."'");
	while ($row = pg_fetch_row($result)) {
		echo "<h1>".$row[0]." ".$row[1]."</h1>";
	}
} ?>
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
<form action="car_admin.php" method="GET">
	<div class="table1">
	<h3>Таблица: Модель</h3>
	<?php
	include ("base.php");
	if(isset($_GET['id'])){
		$model=pg_query($link, 'SELECT * FROM "Model" where id_model='."'".$_GET['id']."'");
		while ($row_m = pg_fetch_row($model)) {
			echo '	
			<textarea name="id" id="id" placeholder="ID">'.$row_m[0].'</textarea><br>
			<textarea name="name" id="name" placeholder="Модель">'.$row_m[1].'</textarea><br>
			<textarea name="brand" id="brand" placeholder="Марка">'.$row_m[2].'</textarea><br>
			<textarea name="descript" id="descript" placeholder="Описание">'.$row_m[3].'</textarea><br><br><br>';
		}
	}
	?>
	
	<h3>Таблица: Выставка</h3>
	<?php
	include ("base.php");
	if(isset($_GET['id'])){
		$comp=pg_query($link, 'SELECT * FROM "Compilation" where id_model='."'".$_GET['id']."'");
		while ($row_c = pg_fetch_row($comp)) {
			echo '	
			<textarea name="region" id="region" placeholder="Регион">'.$row_c[0].'</textarea><br>
			<textarea name="img" id="img" placeholder="Ссылка">'.$row_c[2].'</textarea><br><br><br>';
		}
	}
	?>
	<h3>Таблица: Данные</h3>
	<?php
	include ("base.php");
	if(isset($_GET['id'])){
		$set=pg_query($link, 'SELECT * FROM "Settings" where id_model='."'".$_GET['id']."'");
		while ($row_s = pg_fetch_row($set)) {
			echo '	
			<textarea name="3d_mod" id="name" placeholder="model_name/scene.gltf">'.$row_s[1].'</textarea><br>
			<textarea name="x_size" id="x_size" placeholder="Размер Х">'.$row_s[2].'</textarea><br>
			<textarea name="y_size" id="y_size" placeholder="Размер Y">'.$row_s[3].'</textarea><br>
			<textarea name="z_size" id="z_size" placeholder="Размер Z">'.$row_s[4].'</textarea><br><br><br>';
		}
	}
	?>
	</div>
	
	<div class="table2">
	<h3>Таблица: История</h3>
	<?php
	include ("base.php");
	if(isset($_GET['id'])){
		$hist=pg_query($link, 'SELECT * FROM "History" where id_model='."'".$_GET['id']."'");
		while ($row_h = pg_fetch_row($hist)) {
			echo '	
			<textarea name="owner" id="owner" placeholder="Владелец">'.$row_h[1].'</textarea><br>
			<textarea name="history" id="history" placeholder="История">'.$row_h[2].'</textarea><br>
			<textarea name="years" id="years" placeholder="Год начала">'.$row_h[3].'</textarea><br>
			<textarea name="yeare" id="yeare" placeholder="Год окончания">'.$row_h[4].'</textarea><br><br><br>';
		}
	}
	?>
	<div class="but">
	<input type="submit" name="add" value="Обновить">
	<input type="submit" name="del" value="Удалить"><br>
	</div></div>
</form>
</div>
<?php
include ("base.php");
    if(isset($_GET['add'])){
		$set_del=pg_query($link, 'DELETE FROM "Settings" where id_model='.$_GET['id']);
		$his_del=pg_query($link, 'DELETE FROM "History" where id_model='.$_GET['id']);
		$comp_del=pg_query($link, 'DELETE FROM "Compilation" where id_model='.$_GET['id']);
		$model_del=pg_query($link, 'DELETE FROM "Model" where id_model='.$_GET['id']);
		$model=pg_query($link, 'INSERT INTO "Model" VALUES ('.$_GET['id'].",'".$_GET['name']."','".$_GET['brand']."','".$_GET['descript']."');");
		$comp=pg_query($link, 'INSERT INTO "Compilation" VALUES ('."'".$_GET['region']."',".$_GET['id'].",'".$_GET['img']."');");
		if(empty($_GET['yeare'])) {
			$history=pg_query($link, 'INSERT INTO "History" VALUES ('.$_GET['id'].",'".$_GET['owner']."','".$_GET['history']."','".$_GET['years']."', NULL );");	
		}
		else {
			$history=pg_query($link, 'INSERT INTO "History" VALUES ('.$_GET['id'].",'".$_GET['owner']."','".$_GET['history']."','".$_GET['years']."','".$_GET['yeare']."');");
		}
		$set=pg_query($link, 'INSERT INTO "Settings" VALUES ('.$_GET['id'].",'".$_GET['3d_mod']."',".$_GET['x_size'].",".$_GET['y_size'].",".$_GET['z_size'].");");
		#echo "<meta http-equiv='refresh' content='0'>";
			echo "<script> if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
			}
			window.location = window.location.href;</script>";
	}
?>

<?php
include ("base.php");
    if(isset($_GET['del'])){
		$set_del=pg_query($link, 'DELETE FROM "Settings" where id_model='.$_GET['id']);
		$his_del=pg_query($link, 'DELETE FROM "History" where id_model='.$_GET['id']);
		$comp_del=pg_query($link, 'DELETE FROM "Compilation" where id_model='.$_GET['id']);
		$model_del=pg_query($link, 'DELETE FROM "Model" where id_model='.$_GET['id']);
	}
?>

 <script>
 <?php
include ("base.php");
  $result=pg_query($link, 'SELECT * FROM "Settings" where id_model='."'".$_GET['id']."'");
  while ($row = pg_fetch_row($result)) {
	  $urlad = $row[1];
	  $x_s =$row[2];
	  $y_s =$row[3];
	  $z_s =$row[4];
  }
  echo "let url='".$urlad."',";
  echo "x_s=".$x_s.",";
  echo "y_s=".$y_s.",";
  echo "z_s=".$z_s.",";
  ?>
	  scene, camera, renderer;

      function car() {
	    renderer = new THREE.WebGLRenderer({antialias:true});
        renderer.setSize(window.innerWidth,window.innerHeight);
		renderer.setClearColor(0x000000, 0);
        document.body.appendChild(renderer.domElement);

        scene = new THREE.Scene();
        
		camera = new THREE.PerspectiveCamera(30,window.innerWidth/window.innerHeight,1,3000);

        hlight = new THREE.AmbientLight (0x404040,1);
        scene.add(hlight);

        directionalLight = new THREE.DirectionalLight('white',20);
        directionalLight.position.set(0,1,0);
        directionalLight.castShadow = true;
        scene.add(directionalLight);
        light = new THREE.PointLight(0xc4c4c4,5);
        light.position.set(600,600,-1200);
        light2 = new THREE.PointLight(0xc4c4c4,3);
        light2.position.set(1000,2000,0);
        light3 = new THREE.PointLight(0xc4c4c4,5);
        light3.position.set(0,-700,-500);
        light4 = new THREE.PointLight(0xc4c4c4,4);
        light4.position.set(-300,400,2000);
		light5 = new THREE.PointLight(0xc4c4c4,3);
        light5.position.set(-1000,600,800);
		
		scene.add(light);
		scene.add(light2);
		scene.add(light3);
		scene.add(light4);
		scene.add(light5);
		
		let controls = new THREE.OrbitControls( camera, renderer.domElement );

        camera.rotation.y = 45/180*Math.PI;
        camera.position.x = 600;
        camera.position.y = 600;
        camera.position.z = -1200;
		controls.update();
		
        loader = new THREE.GLTFLoader();
        loader.load(url, function(gltf){
          car = gltf.scene.children[0];
          car.scale.set(x_s,y_s,z_s);
          scene.add(gltf.scene);
          animate();
        });
      }
      function animate() {
        renderer.render(scene,camera);
        requestAnimationFrame(animate);
      }
	  car();
  </script>
  
</body>
</html>