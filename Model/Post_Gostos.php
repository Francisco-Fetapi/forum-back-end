<?php

    namespace Model;

    session_start();
    class Post_Gostos extends Model{

        public function __construct(){
            parent::Conectar();
        }

        public function likar($id_usuario,$id_post){
            $usuario_id = $id_usuario ?? $_SESSION['id_usuario'];
            $sql ='';
            if($this->ja_likou($id_usuario,$id_post)){
                $sql = Model::$BD->prepare("DELETE FROM posts_gostos WHERE id_usuario = ? AND id_post = ?");
            }else{
                $sql = Model::$BD->prepare("INSERT INTO posts_gostos (id_usuario,id_post) VALUES(?,?)");
            }
            
            $sql->execute([$usuario_id,$id_post]);

            return true;
        }
        public function ja_likou($id_usuario,$id_post){
            $sql = Model::$BD->prepare("SELECT * FROM posts_gostos WHERE id_usuario = ? AND id_post = ?");
            $sql->execute([$id_usuario,$id_post]);

            return $sql->rowCount();
        }
        public function dislikar($id_post){
            if(isset($_SESSION['id_usuario'])){
                $sql = Model::$BD->prepare("DELETE FROM posts_gostos WHERE id_post = ? AND id_usuario = ? ");
                $sql->execute([$id_post,$_SESSION['id_usuario']]);
                return true;
            }
            return false;
        }
        public function listar(){
            $sql = Model::$BD->query("SELECT * FROM posts_gostos");
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

?>