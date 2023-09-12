<?php
$link = pg_connect("hostaddr=127.0.0.1 port=5432 dbname=museum user=postgres password=123");
if (!$link) {
	echo "нет бд";
};
?>