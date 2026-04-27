<?php

require_once "Core/Autoloader.php";

require_once "Core/functions.php";
$config = require "config.php";

$db = new Database($config["database"]);

require_once "Core/router.php";
