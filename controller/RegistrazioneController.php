<?php
require_once './controller/MainController.php';
class RegistrazioneController extends MainController
{
    public function make()
    {
        include './view/registrazione.php';

    }

    public function nuovoUtente()
    {
        if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['password'])) {
            $result = Query::emailAvailable($_POST['email'],$_POST['nome']);
            if($result===false){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $utente = new User($nome, $email, $password,0);

                $result = Query::insertObjectUser($utente);
                if ($result) {
                    if(!isset($_SESSION)){
                        session_start();
                        session_regenerate_id(true);
                    }
                    
                    $_SESSION['email'] = $utente->getEmail();
                    header("location: index.php?controller=HomepageController&action=make");
                    exit();
                } else {
                   
                }
            }else{
                header("location: index.php?controller=RegistrazioneController&action=make&e=1");
               exit();
            }
           

        }
    }

}