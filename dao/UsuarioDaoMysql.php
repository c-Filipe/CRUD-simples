<?php

    require_once 'models/usuarios.php';
    

    class UsuarioDaoMysql implements UsuarioDao {

         private $pdo;

        public function __construct(PDO $driver){
            $this->pdo = $driver;

        }

        public function add(Usuario $u){
            $sql = $this->pdo->prepare("INSERT INTO usuarios (nome,email) VALUES (:nome,:email)");
            $sql->bindValue(':nome', $u->getNome());
            $sql->bindValue(':email', $u->getEmail());
            $sql->execute();

            $u->setId($this->pdo->lastInsertId());
            return $u;

        }

        public function findAll(){

            $array = [];
            $sql = $this->pdo->query("SELECT * FROM usuarios");
            
            if($sql->rowCount() > 0) {
                $lista = $sql->fetchAll();

                foreach($lista as $item){
                    $user = new Usuario();
                    $user->setId($item['id']);
                    $user->setNome($item['nome']);
                    $user->setEmail($item['email']);
                    $array[] = $user;
                }
            }

            return $array;

        }

        public function findById($id){
            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $data = $sql->fetch();

                $u = new Usuario();
                $u->setId($data['id']);
                $u->setNome($data['nome']);
                $u->setEmail($data['email']);

                return $u;
            }
            else{
                return false;
            }
            
        }
        public function findByEmail($email){
            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
            $sql->bindValue(':email',$email);
            $sql->execute();
            if($sql->rowCount() > 0){
                $lista = $sql->fetchAll();

                $user = new Usuario();
                $user->setId($lista['id']);
                $user->setNome($lista['nome']);
                $user->setEmail($lista['email']);

                return $user;

            }
            else{
                return false;

            }

        }

        public function update(Usuario $u){
            $sql = $this->pdo->prepare("UPDATE usuarios SET nome = :nome , email = :email WHERE id=:id ");
            $sql->bindValue(':nome',$u->getNome());
            $sql->bindValue(':email',$u->getEmail());
            $sql->bindValue(':id',$u->getId());
            $sql->execute();

            return true;

           

        }

        public function delete($id){
            $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

        }
    }

?>