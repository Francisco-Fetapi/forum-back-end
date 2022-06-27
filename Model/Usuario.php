<?php


    namespace Model;
    session_start();
    class Usuario extends Model{
        
        private $id;
        private $nome;
        private $genero;
        private $num_tel;
        private $senha;
        private $foto;
        private $permitido;

        public function __construct(){
            parent::Conectar();
        }
        public function setInfo($nome,$genero,$num_tel,$senha){            
            $this->nome = $nome;            
            $this->genero = $genero;            
            $this->num_tel = $num_tel;            
            $this->senha = $senha;            
            $this->foto = 'user.jpg';            
            $this->permitido = 'sim';
        }
        public function getInfo(){
            return [
                'id'=>$this->id,
                'nome'=>$this->nome,
                'genero'=>$this->genero,
                'num_tel'=>$this->num_tel,
                'senha'=>$this->senha,
                'foto'=>$this->foto,
                'permitido'=>$this->permitido,
            ];
        }
        public function cadastrar(){
            if($this->num_id_existe()){
                return false;
            }
            extract($this->getInfo());
            $sql = Model::$BD->prepare("INSERT INTO usuarios VALUES(DEFAULT,?,?,?,?,?,?)");
            $sql->execute([$nome,$genero,$num_tel,md5($senha),$foto,$permitido]);
            
            $usuario = $this->get_usuario_by_num_tel();
            $this->iniciar_sessao($usuario['id']);
            return true;
        }
        public function getAllUsers():array{
            $sql = Model::$BD->query("SELECT * FROM usuarios");
            $sql = $sql->fetchAll(\PDO::FETCH_ASSOC);

            return $sql;
        }
        public function get_usuario_by_num_tel(){
            $sql = Model::$BD->prepare("SELECT * FROM usuarios WHERE num_tel = ? ");
            $sql->execute([$this->num_tel]);
            $dados = $sql->fetch(\PDO::FETCH_ASSOC);

            return $dados;
        }
        public function num_id_existe(){
            $sql = Model::$BD->query("SELECT * FROM usuarios WHERE num_tel = '$this->num_tel'");
            
            return $sql->rowCount();
        }
        public function logar($num_tel,$senha){
            $sql = Model::$BD->prepare("SELECT * FROM usuarios WHERE num_tel = ? AND senha = ?");
            $sql->execute([$num_tel,md5($senha)]);

            $dados = $sql->fetch(\PDO::FETCH_ASSOC);

            if($dados){ //se o usuario existe
                $this->iniciar_sessao($dados['id']);
            }
            return $dados;
        }
        public function iniciar_sessao($id){
            $_SESSION['id_usuario'] = $id;
        }
        public function terminar_sessao(){
            unset($_SESSION['id_usuario']);
        }
        public function verificar_se_ha_sessao(){
            if(isset($_SESSION['id_usuario'])){
                return $_SESSION['id_usuario'];
            }else{
                return false;
            }
        }
        public function get_user_by_id($id){
            $sql = Model::$BD->prepare("SELECT * FROM usuarios WHERE id = ? ");
            $sql->execute([$id]);

            $dados = $sql->fetch(\PDO::FETCH_ASSOC);

            return $dados;
        }
        public function alterar_dados_usuario($nome,$genero,$num_tel,$id_usuario){
            $sql = Model::$BD->prepare("UPDATE usuarios SET nome = ?,genero = ?,num_tel = ? WHERE id = ? ");
            return $sql->execute([$nome,$genero,$num_tel,$id_usuario]);
        }
        public function alterar_senha($senha,$nova_senha,$id_usuario){
            $sql = Model::$BD->prepare("SELECT * FROM usuarios WHERE senha = ? AND id = ?");
            $sql->execute([md5($senha),$id_usuario]);

            if($sql->rowCount() > 0){
                $sql = Model::$BD->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
                $sql->execute([md5($nova_senha),$id_usuario]);

                return true;
            }
            return false;
        }
        public function alterar_foto($foto,$id_usuario){

            $usuario = $this->get_user_by_id($id_usuario);
            $foto_antiga = $usuario['foto'];
            if($usuario['foto'] != $this->foto){ //se nao eh a foto padrao
                unlink("../img/$foto_antiga");
            }

            $sql = Model::$BD->prepare("UPDATE usuarios SET foto = ? WHERE id=? ");
            $sql->execute([$foto,$id_usuario]);
        }
    }
?>