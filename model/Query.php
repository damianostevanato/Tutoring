<?php
require_once './controller/Database.php';
require_once './model/Password.php';
class Query
{
    public function emailAvailable($email,$nome){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM utente WHERE email=:email OR nome_utente=:nome_utente");
        $stmt->bindValue(":email",$email);
        $stmt->bindValue(":nome_utente",$nome);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
           
            if(count($result)>0){
                return true;
            }else{
                return false;
            }
        }else{
            return $stmt->errorCode();
        }
    }

    public static function insertObjectUser($user)
    {
        $conn = Database::getConnection();
        $password=password::getHash($user->getPassword());
        $stmt = $conn->prepare("INSERT INTO utente (nome_utente,email,password,ruolo) VALUES (:nome,:email,:password,:ruolo)");
        $stmt->bindValue(":nome", $user->getNome());
        $stmt->bindValue(":email", $user->getEmail());
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":ruolo", $user->getRuolo());
        if ($stmt->execute()) {
            return true;
        } else {
            return $stmt->errorCode();
        }

    }
    public static function insertDomanda($testo_domanda,$email,$titolo_domanda,$data,$id_materia){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO domanda (testo_domanda,email,titolo_domanda,data,id_materia) VALUES (:testo_domanda,:email,:titolo_domanda,:data,:id_materia)");
        $stmt->bindValue(":testo_domanda", $testo_domanda);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":titolo_domanda", $titolo_domanda);
        $stmt->bindValue(":data", $data);
        $stmt->bindValue(":id_materia", $id_materia);
        if ($stmt->execute()) {
            return true;
        } else {
            return $stmt->errorCode();
        }
    }
    public static function insertMateria($nome_materia){

        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT nome_materia FROM materia WHERE nome_materia=:nome_materia");
        $stmt->bindValue(":nome_materia", $nome_materia);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
            if(count($result)===0){
                $stmt = $conn->prepare("INSERT INTO materia (nome_materia) VALUES (:nome_materia)");
                $stmt->bindValue(":nome_materia", $nome_materia);
                if ($stmt->execute()) {
                    return true;
                } else {
                    return $stmt->errorCode();
                }
               
            }else{
                return false;
            }
        } else {
            return $stmt->errorCode();
        }
        
    }
    public static function updateObjectUser($user,$session_mail){
        $conn = Database::getConnection();
        $password=password::getHash($user->getPassword());
        $stmt = $conn->prepare("UPDATE utente SET email=:email,nome_utente=:nome_utente,password=:password WHERE email=:email1");
        $stmt->bindValue(":email", $user->getEmail());
        $stmt->bindValue(":nome_utente", $user->getNome());
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":email1", $session_mail);
        if ($stmt->execute()) {
            return true;
        } else {
            return $stmt->errorCode();
        }
        
    }
    public static function deleteMateria($id_materia){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE materia SET deleted='1' WHERE id_materia=:id_materia");
        $stmt->bindValue(":id_materia", $id_materia);
        if ($stmt->execute()) {
            return $stmt->execute();
        } else {
            return $stmt->errorCode();
        }
    }
    public static function deleteDomanda($id_domanda){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE domanda SET deleted='1' WHERE id_domanda=:id_domanda");
        $stmt->bindValue(":id_domanda", $id_domanda);
        if ($stmt->execute()) {
            return $stmt->execute();
        } else {
            return $stmt->errorCode();
        }
    }
    public static function selectForDomandaByIdMateria($id_materia)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM domanda WHERE id_materia=:id_materia AND deleted=0");
        $stmt->bindValue(":id_materia", $id_materia);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return $stmt->errorCode();
        }
    }
    public static function selectForDomandaByIdDomanda($id_domanda)
    {	
	
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT domanda.*,COUNT(*) as Numero_risposte,utente.nome_utente FROM domanda,risposta,utente WHERE domanda.email=utente.email AND domanda.id_domanda=risposta.id_domanda AND domanda.id_domanda=:id_domanda");
        $stmt->bindValue(":id_domanda", $id_domanda);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return $stmt->errorCode();
        }
    }
    public static function selectForRisposteByIdDomanda($id_domanda)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM risposta WHERE id_domanda=:id_domanda");
        $stmt->bindValue(":id_domanda", $id_domanda);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return $stmt->errorCode();
        }
    }

    public static function selectForMateria($id_materia)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM materia WHERE id_materia=:id_materia");
        $stmt->bindValue(":id_materia", $id_materia);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return $stmt->errorCode();
        }
    }
    public static function getRisposteByIDDomanda($id){
        $conn = Database::getConnection();
        $query="SELECT risposta.*,utente.nome_utente FROM risposta,utente WHERE risposta.email=utente.email AND risposta.id_domanda=:id_domanda";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(":id_domanda",$id);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            return $result;
        }
        else{
            return $stmt->errorCode();
        }
    }

    public static function selectForLogin($user)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT nome_utente,email,password,ruolo FROM utente WHERE email=:email");
        $stmt->bindValue(":email", $user->getEmail());
        
        if ($stmt->execute()) {
            $result = $stmt->fetchAll();
            if(count($result)>0){
                foreach($result as $row){
                    $hash = $row['password'];
                }
                $password=$user->getPassword();
                $result=password::verifyPassword($hash,$password);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        } else {
            return $stmt->errorCode();
        }
    }

    public static function getUserDetailsByEmail($email)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM utente WHERE email=:email");
        $stmt->bindValue(":email", $email);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } else {
            return $stmt->errorCode();
        }
    }
   
    public static function selectForMaterie(){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM materia WHERE deleted=0");
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return $stmt->errorCode();
        }
    }
    public static function insertAnswer($email,$text,$id_domanda,$id_materia){
        $conn = Database::getConnection();
        $query = "INSERT INTO risposta (id_risposta,testo_risposta,id_materia,id_domanda,email) VALUES (0,:testo,:id_materia,:id_domanda,:email)";
        $stmt = $conn ->prepare($query);
        $stmt->bindValue(":testo",$text);
        $stmt->bindValue(":id_materia",$id_materia);
        $stmt->bindValue(":id_domanda",$id_domanda);
        $stmt->bindValue(":email",$email);
        $result=$stmt->execute();
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }

}