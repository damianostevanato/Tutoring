<?php
require_once 'Query.php';


class password
{
    public static function getHash($plainText){
        $password = "";
        $option = ['cost' => 12];
        $password = password_hash($plainText,PASSWORD_BCRYPT,$option);
        return $password;
    }

    public static function showAppropriateCost(){

        /**
         * This code will benchmark your server to determine how high of a cost you can
         * afford. You want to set the highest cost that you can without slowing down
         * you server too much. 8-10 is a good baseline, and more is good if your servers
         * are fast enough. The code below aims for ≤ 50 milliseconds stretching time,
         * which is a good baseline for systems handling interactive logins.
         */
        $timeTarget = 0.05; // 50 milliseconds

        $cost = 8;
        do {
            $cost++;
            $start = microtime(true);
            password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
            $end = microtime(true);
        } while (($end - $start) < $timeTarget);

        return $cost;

    }

    public static function verifyPassword($hash,$password){
        $result = false;
        $result = password_verify($password,$hash);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }
}