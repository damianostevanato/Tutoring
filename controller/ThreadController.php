<?php
require_once './controller/MainController.php';
class ThreadController extends MainController
{
    public function make(){
        
        $controller = substr(__FILE__, 51, -4);
        $_SESSION['page'] = $controller;
        if(isset($_POST['id_domanda'])){
            $_SESSION['id_domanda'] = $_POST['id_domanda'];
        }
		if(isset($_POST['id_materia'])){
            $_SESSION['id_materia'] = $_POST['id_materia'];
        }
		
        include "./view/thread.php";
    }

    public function getDomanda(){
       
        if(isset($_SESSION['id_domanda'])){
           
            $result = Query::selectForDomandaByIdDomanda($_SESSION['id_domanda']);
			
            
            exit(json_encode(array('error'=>0,'result'=>$result)));
        }else{

        }
    }

    public function getRisposte(){
       
        if(isset($_SESSION['id_domanda'])){
            $id_domanda = $_SESSION['id_domanda'];
            $result=Query::getRisposteByIDDomanda($id_domanda);
            exit(json_encode(array('error'=>0,'result'=>$result)));
        }
    }

    public function sendAnswer(){
      
        if(isset($_SESSION['id_domanda'])){
            $id_domanda = $_SESSION['id_domanda'];
            $email = $_SESSION['email'];
            $text = $_POST['answer'];
            $id_materia=$_SESSION['id_materia'];
            $result = Query::insertAnswer($email,$text,$id_domanda,$id_materia);
            if($result){
                header("location:index.php?controller=ThreadController&action=make&tab=1");
            }
        }
    }
}