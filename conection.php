<?php

	$pass = '';
	$user = 'root';
	$db_name= 'api_php';

	try{
		$db = new PDO(
			'mysql:host=localhost;
			dbname='.$db_name,
			$user,
			$pass,
			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
		);
	}catch(Exception $e){
		echo "Error de conexión ".$e->getMessage();
	}





















?>