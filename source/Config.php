<?php

	define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "bancoapirest",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", //Qual será o charset
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Se vai ou não mostrar as exceções 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //Vai converter qualquer resultado em objetos
        PDO::ATTR_CASE => PDO::CASE_NATURAL //vai fazer a conversão de todos os cases para normal (tirar de maiúsculo para minúsculo)
    ]
]);


?>