<?php

class Sessions {
    public static $now;

    public static function init() {
        self::$now = time();
    }

    public static function set($username, $rights) {
        self::init();

        $_SESSION['username'] = $username;
        $_SESSION['rights'] = $rights;        
        $_SESSION['discard_after'] = self::$now + 3600;
    }

    public static function discard() {
        session_unset();
        session_destroy();

        $_SESSION = []; 
    }

    public static function validate() {
        self::init();
        
        if (!empty($_SESSION['discard_after']) && self::$now > $_SESSION['discard_after']) {
            self::discard();
            session_start();
            
            return false;
        }
        if (empty($_SESSION['username'])) {
            return false;
        }
        return true;
    }
}