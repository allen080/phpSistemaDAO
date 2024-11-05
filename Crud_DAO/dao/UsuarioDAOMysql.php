<?php
require_once "models/Usuario.php";

class UsuarioDAOMysql implements UsuarioDAO {
    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    public function add(Usuario $usuario){
        // adiciona usuario no banco
        $sqlAdd = $this->pdo->prepare("INSERT INTO usuarios (nome,email) VALUES (:nome, :email)");
        
        $sqlAdd->bindValue(":nome", $usuario->getNome());
        $sqlAdd->bindValue(":email", $usuario->getEmail());
        $sqlAdd->execute();

        // configura o ID do usuario
        $usuario->setId($this->pdo->lastInsertId());
        return $usuario;
    }

    public function findAll(){
        // retorna todos os dados de usuarios cadastrados no banco
        $sqlGetUsuarios = $this->pdo->query("SELECT * FROM usuarios");
        $usuarios = [];

        if($sqlGetUsuarios->rowCount() > 0){
            $sqlDados = $sqlGetUsuarios->fetchAll(PDO::FETCH_ASSOC);

            foreach($sqlDados as $dado){
                $usuario = new Usuario();
                $usuario->setNome($dado["nome"]);
                $usuario->setEmail($dado["email"]);
                $usuario->setId($dado["id"]);

                $usuarios[] = $usuario;
            }
        }

        return $usuarios;
    }

    public function findByEmail(string $email){
        $sqlCheckEmail = $this->pdo->prepare("SELECT * FROM usuarios WHERE email=:email");
        $sqlCheckEmail->bindValue(":email", $email);
        $sqlCheckEmail->execute();

        if($sqlCheckEmail->rowCount() === 0){// usuario nao encontrado
            return false;
        }
        
        $data = $sqlCheckEmail->fetch();

        return new Usuario($data["nome"], $data["email"], $data["id"]);
    }

    public function findById($id){
        $todosUsuarios = $this->findAll();

        foreach($todosUsuarios as $usuario){
            if($usuario->getId() === $id){
                return $usuario;
            }
        }

        return false;
    }

    public function update(Usuario $usuario){
        // atualiza os dados de um usuario
        $sqlUpdate = $this->pdo->prepare("UPDATE usuarios SET nome=:nome, email=:email WHERE id=:id");
        
        $sqlUpdate->bindValue(':nome', $usuario->getNome());
        $sqlUpdate->bindValue(':email', $usuario->getEmail());
        $sqlUpdate->bindValue(':id', $usuario->getId());
        $sqlUpdate->execute();
    }

    public function remove($id){
        // deleta do banco de dados
        $sqlRemove = $this->pdo->prepare("DELETE FROM usuarios WHERE id=:id");
        $sqlRemove->bindValue("id", $id);
        $sqlRemove->execute();
    }

}

?>