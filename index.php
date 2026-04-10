<?php


require_once "Database.php";
require_once "functions.php";

$config = require "config.php";
$db = new Database($config["database"]);

require_once "router.php";
