<?php
require_once './controller/MainController.php';
class newThreadController extends MainController
{
    public function make(){
        $path = __FILE__;
		$arr = explode('\\',$path);
		$arr1 = explode('.',$arr[6]);
        $_SESSION['page'] = $arr1[0];
        $_SESSION['id_materia'] = $_POST['materia'];
       include "./view/newThread.php";
    }
    public function nuovaDomanda(){
        
       
        $titolo = $_POST['titolo_domanda'];
        $testo = $_POST['testo_domanda'];
        $id_materia = $_SESSION['id_materia'];
        $email = $_SESSION['email'];
        $date = date("Y/m/d",time());  
       
        Query::insertDomanda($testo,$email,$titolo,$date,$id_materia);
        header("location: index.php?controller=MateriaController&action=make");
    }
   
}