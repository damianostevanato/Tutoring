<?php
class User
{
    private $nome;
    private $email;
    private $password;
    private $ruolo;

    public function __construct($nome, $email, $password,$ruolo)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->password = $password;
        $this->ruolo = $ruolo;

    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setRuolo($ruolo)
    {
        $this->ruolo = $ruolo;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function getRuolo()
    {
        return $this->ruolo;
    }
    public function getUser(){
        return $array = [
            'nome'=>$this->nome,
            'email'=>$this->email,
            'password'=>$this->password,
        ];
    }
}
class Users{
    public static function insertObjectUser($user)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO utente (nome_utente,email,password) VALUES (:nome,:email,:password)");
        $stmt->bindValue(":nome", $user->getNome());
        $stmt->bindValue(":email", $user->getEmail());
        $stmt->bindValue(":password", $user->getPassword());
        if ($stmt->execute()) {
            return true;
        } else {
            return $stmt->errorCode();
        }

    }
}