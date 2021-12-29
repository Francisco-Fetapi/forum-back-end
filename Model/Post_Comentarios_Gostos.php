<?php

    namespace Model;

    session_start();
    class Post_Comentarios_Gostos extends Model{

        public function __construct(){
            parent::Conectar();
        }

        public function likar($id_usuario,$id_comentario){
            $usuario_id = $_SESSION['id_usuario'] ?? $id_usuario;
            if($this->ja_likou($id_usuario,$id_comentario)['rowCount']){
                $sql = Model::$BD->prepare("DELETE FROM posts_comentarios_gostos WHERE id_usuario = ? AND id_comentario = ?");
            }else{
                $sql = Model::$BD->prepare("INSERT INTO posts_comentarios_gostos VALUES(DEFAULT,?,?)");
            }
            $sql->execute([$usuario_id,$id_comentario]);
            return true;
        }
        public function dislikar($id_comentario){
            if(isset($_SESSION['id_usuario'])){
                $sql = Model::$BD->prepare("DELETE FROM posts_comentarios_gostos WHERE id_comentario = ? AND id_usuario = ? ");
                $sql->execute([$id_comentario,$_SESSION['id_usuario']]);
                return true;
            }
            return false;
        }
        public function listar(){
            $sql = Model::$BD->query("SELECT * FROM posts_comentarios_gostos");
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
        public function ja_likou($id_usuario,$id_comentario){
            $sql = Model::$BD->prepare("SELECT * FROM posts_comentarios_gostos WHERE id_usuario = ? AND id_comentario = ?");
            $sql->execute([$id_usuario,$id_comentario]);

            $dados = ['rowCount'=>$sql->rowCount()];

            $sql = Model::$BD->prepare("SELECT * FROM posts_comentarios_gostos WHERE id_usuario = ?");
            $sql->execute([$id_usuario]);
            $gostados = $sql->fetchAll(\PDO::FETCH_ASSOC);
            $dados['gostados'] = $gostados;
            
            return $dados;
        }
    }

?>