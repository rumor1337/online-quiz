<?php

session_start();

if (!Sessions::validate() || !Rights::checkRights('admin')) {
    http_response_code(401);
    header("Location: /");
    exit();
}

require "views/admin/index.view.php";