<?php
require_once './controller/MainController.php';

class MateriaController extends MainController
{
    public function make()
    {

       
        $path = __FILE__;
		$arr = explode('\\',$path);
		$arr1 = explode('.',$arr[6]);
        $_SESSION['page'] = $arr1[0];
        
        if(isset($_POST['materia'])){
            $_SESSION['id_materia'] = $_POST['materia'];
        }
		
        include './view/materia.php';
    }
       


    public function getDomande()
    {
        
        
        if (isset($_SESSION['id_materia'])) {
            $id_materia = $_SESSION['id_materia'];
            $result = Query::selectForDomandaByIdMateria($id_materia);

            exit(json_encode(array('error' => 0, 'result' => $result)));
        } else {
            exit(json_encode(array('error' => 1)));
        }
    }

    public function getMateria()
    {
        
        if (isset($_SESSION['id_materia'])) {
            $id_materia = $_SESSION['id_materia'];
            $result = Query::selectForMateria($id_materia);
            exit(json_encode(array('error' => 0, 'result' => $result)));
        } else {
            exit(json_encode(array('error' => 1)));
        }
    }
    public function deleteDomanda(){
      
       exit(json_encode(Query::deleteDomanda($_POST['id_domanda'])));
    }

}