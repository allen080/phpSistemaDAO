<?php
class Usuario {
    private $nome;
    private $email;
    private $id;

    public function __construct(string $nome="", string $email="", $id=0)
    {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setId($id);
    }

    public function getNome(){
        return $this->nome;
    }
    public function setNome(string $nome){
        $this->nome = ucwords(trim($nome));
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail(string $email){
        $this->email = strtolower(trim($email));
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
}

interface UsuarioDAO {
    public function add(Usuario $usuario);
    public function findAll();
    public function findById($id);
    public function update(Usuario $usuario);
    public function remove($id);
}


?>