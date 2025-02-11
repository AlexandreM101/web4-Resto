<?php

$bdd = new PDO("sqlite:" . __DIR__ . "/../alex_bd_resto.db");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
