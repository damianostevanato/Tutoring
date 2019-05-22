<?php
require_once './controller/MainController.php';
require_once './model/Password.php';
class ModificaController extends MainController
{
    public function make()
    {
        $path = __FILE__;
		$arr = explode('\\',$path);
		$arr1 = explode('.',$arr[6]);
        $_SESSION['page'] = $arr1[0];
        include './view/modifica.php';

    }

    public function modificaUtente()
    {
      
        if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['password_conf'])) {
            $result = Query::getUserDetailsByEmail($_SESSION['email']);
            
            if($_POST['password']!==""){
                $isChanged=password::verifyPassword($result[0]['password'],$_POST['password']);
                if($isChanged===false){
                    $password = $_POST['password'];
                }
            }else{
                $password = $_POST['password_conf'];
            }

            if($_POST['nome']!==$result[0]['nome_utente']){
                $nome=$_POST['nome'];
            }else{
                $nome = $result[0]['nome_utente'];
            }

            if($_POST['email']!==$result[0]['email']){
                $email=$_POST['email'];
            
            }else{
                $email = $result[0]['email'];
            }
            $_SESSION['email']=$email;
            $utente = new User($nome, $email, $password,null);
           
           if(Query::updateObjectUser($utente,$_SESSION['email'])){
                $page = $_SESSION['page'];
                header('location: index.php?controller=' . $page . '&action=make');
            }else{
                exit();
            }

            
        }
    }

}