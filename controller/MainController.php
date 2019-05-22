<?php
require_once './model/Query.php';
require_once './model/User.php';
class MainController
{
    public function login()
    {
       
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $utente = new User(null, $email, $password,null);
            if (Query::selectForLogin($utente)) {
                
                $_SESSION['email'] = $utente->getEmail();
               header('location: index.php?controller=' . $_SESSION['page'] . '&action=make');
               exit();
            } else {
                header('location: index.php?controller=' . $_SESSION['page'] . '&action=make&e=1');
                exit();
            }
        }
    }

    public function checkLogin()
    {

        
        //var_dump($_SESSION);
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $result = Query::getUserDetailsByEmail($email);
            exit(json_encode(array('error' => 0, 'result' => $result)));
        } else {
            exit(json_encode(array('error' => 1)));
        }
    }

    public function logOut()
    {
      
        if (isset($_SESSION['page']) && isset($_SESSION['email'])) {
            $page = $_SESSION['page'];
            unset($_SESSION['email']);
            //session_destroy();
            header('location: index.php?controller=' . $page . '&action=make');
            exit();
        } else {
            exit();
        }
    }
    
}