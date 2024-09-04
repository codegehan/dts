<?php 
class Authorize {
    public static function isAccountSecured() {
        $user = json_decode($_SESSION['userdetails']);
        $issecured = $user->issecured;
        if (isset($issecured) && $issecured != null && $issecured != 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>