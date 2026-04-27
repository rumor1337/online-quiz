<?php

class Rights {

    public static function checkRights($neededRight) {
        switch($neededRight) {
            case 'admin':
                return self::verifyRights('admin');
            case 'all':
                return self::verifyRights('all');
            default:
                return false;
        }
    }

    public static function verifyRights($rights) {
        if($rights == 'all' || $rights == $_SESSION['rights']) {
            return true;
        } else if($rights != $_SESSION['rights']) {
            return false;
        }
    }

}