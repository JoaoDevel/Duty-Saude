<?php

class Session {

    public function __construct() {
        
    }

    public function validade() {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION['USER'])) {
                $_SESSION['USER'] = array();
                session_unset();
                session_destroy();
                throw new Exception("Login não realizado");
            }
            return true;
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
            return false;
        }
    }

    public function create($code, $data) {
        try {
            if ($code != 200) {
                throw new Exception("error");
            }
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $array = [
                'COD' => $data["id"],
                'NAME' => $data["name"],
                'EMAIL' => $data["email"],
                'NIVEL' => $data["nivel"],
                'STATUS' => $data["status"],
                'RESET' => $data["reset_pass"],
                'REFRH' => false,
            ];

            $_SESSION['USER'] = $array;

            return true;
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
            return false;
        }
    }
}
