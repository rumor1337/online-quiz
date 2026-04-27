<?php

session_start();
Sessions::discard();

header('Location: /'); exit();