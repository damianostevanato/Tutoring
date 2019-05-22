<?php
require_once './controller/MainController.php';

class HomepageController extends MainController
{
    public function make()
    {
    
        

		$path = __FILE__;
		$arr = explode('\\',$path);
		$arr1 = explode('.',$arr[6]);
        $_SESSION['page'] = $arr1[0];
       
        include './view/homepage.php';

    }
    public function getSections(){
        exit(json_encode(Query::selectForMaterie()));
    }
    public function nuovaSezione(){
        exit(json_encode(Query::insertMateria(urldecode($_POST['nome_materia']))));
    }
    public function cancellaSezione(){
        
        exit(json_encode(Query::deleteMateria(urldecode($_POST['id_materia']))));
    }

}