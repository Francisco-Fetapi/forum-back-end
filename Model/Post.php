<?php

    namespace Model;
    session_start();
    class Post extends Model{

        public function __construct(){
            parent::Conectar();
        }
        public function criar($titulo,$conteudo,$id_usuario){
            $usuario_id = $_SESSION['id_usuario'] ?? $id_usuario;
            if(isset($_SESSION['id_usuario']) || isset($id_usuario)){
                $sql = Model::$BD->prepare("INSERT INTO posts VALUES(DEFAULT,?,?,?,NOW())");
                $sql->execute([$usuario_id,$titulo,$conteudo]);
                return true;
            }
            return false;
        }
        public function listar(){
            $sql = Model::$BD->query("SELECT * FROM posts");
            $sql = $sql->fetchAll(\PDO::FETCH_ASSOC);
            return $sql;
        }
        public function eliminar($id_post){
            $sql = Model::$BD->prepare("DELETE FROM posts WHERE id = ?");
            $sql->execute([$id_post]);

            // Eliminar os comentarios do POST
            $sql = Model::$BD->prepare("DELETE FROM posts_comentarios WHERE id_post = ?");
            $sql->execute([$id_post]);

            // Eliminar os gostos do POST
            $sql = Model::$BD->prepare("DELETE FROM posts_gostos WHERE id_post = ?");
            $sql->execute([$id_post]);

            return true;
        }
        public function existe_este_titulo($titulo){
            $sql = Model::$BD->prepare("SELECT * FROM posts WHERE titulo = ? ");
            $sql->execute([$titulo]);

            return $sql->rowCount();
        }
        public function editar($titulo,$conteudo,$id){
            $sql = Model::$BD->prepare("UPDATE posts SET titulo = ? , conteudo = ? WHERE id = ? ");
            $sql->execute([$titulo,$conteudo,$id]);

            return true;
        }
        public function ultimos_posts($id_usuario){
            $sql = Model::$BD->prepare("SELECT * FROM posts WHERE id_usuario = ? ORDER BY id DESC LIMIT 3");
            $sql->execute([$id_usuario]);
            $dados = $sql->fetchAll(\PDO::FETCH_ASSOC);
            return $dados;
        }
        public function buscar_dados_post($id_post){
            $sql = Model::$BD->prepare("SELECT p.id as 'id_post',p.titulo,p.conteudo,p.data,
            u.id as 'id_usuario',u.nome,u.foto
            FROM posts p JOIN usuarios u ON p.id_usuario = u.id WHERE p.id = ? ORDER BY p.id DESC");

            $sql->execute([$id_post]);
            $post = $sql->fetch(\PDO::FETCH_ASSOC); 

            $post['data'] = date('d/m/Y',strtotime($post['data']));
            // ADD gostos ao POST!
            $id_post = $post['id_post'];

            $sql = Model::$BD->prepare("SELECT * FROM posts_gostos WHERE id_post = ?");
            $sql->execute([$id_post]);
            $num_gostos = $sql->rowCount();
            $post['gostos'] = $num_gostos;
            // ADD comentarios ao POST!
            $sql = Model::$BD->prepare("SELECT * FROM posts_comentarios WHERE id_post = ?");
            $sql->execute([$id_post]);
            $num_comentarios = $sql->rowCount();
            $post['comentarios'] = $num_comentarios;
            
            return $post;
        }
        public function obter_todos_os_posts(){
            $limite = $_GET['limite'] ?? $_POST['limite'];
            if($limite !== ''){
                $query = "SELECT p.id as 'id_post',p.titulo,p.conteudo,p.data,
                u.id as 'id_usuario',u.nome,u.foto
                FROM posts p JOIN usuarios u ON p.id_usuario = u.id 
                ORDER BY p.id DESC
                LIMIT $limite
                ";
            }else{
                $query = "SELECT p.id as 'id_post',p.titulo,p.conteudo,p.data,
                u.id as 'id_usuario',u.nome,u.foto
                FROM posts p JOIN usuarios u ON p.id_usuario = u.id ORDER BY p.id DESC";
            }
            $sql = Model::$BD->query($query);
            $posts = $sql->fetchAll(\PDO::FETCH_ASSOC); 

            // ADD gostos e formatar data aos POSTS!
            foreach($posts as &$post){
                $id_post = $post['id_post'];
                $sql = Model::$BD->prepare("SELECT * FROM posts_gostos WHERE id_post = ?");
                $sql->execute([$id_post]);
                $num_gostos = $sql->rowCount();
                $post['gostos'] = $num_gostos;
                $post['data'] = date('d/m/Y',strtotime($post['data']));
            }
            // ADD comentarios aos POSTS!
            foreach($posts as &$post){
                $id_post = $post['id_post'];
                $sql = Model::$BD->prepare("SELECT * FROM posts_comentarios WHERE id_post = ?");
                $sql->execute([$id_post]);
                $num_comentarios = $sql->rowCount();
                $post['comentarios'] = $num_comentarios;
            }
            return $posts;
        }
        public function filtrar_posts($query){
            $q = addslashes($query);
            $sql = Model::$BD->query("SELECT p.id as 'id_post',p.titulo,p.conteudo,p.data,
            u.id as 'id_usuario',u.nome,u.foto
            FROM posts p JOIN usuarios u ON p.id_usuario = u.id 
            WHERE p.titulo LIKE '%$q%'
            OR p.conteudo LIKE '%$q%'
            OR u.nome LIKE '%$q%'
            ORDER BY p.id DESC");

            $posts = $sql->fetchAll(\PDO::FETCH_ASSOC); 

            // ADD gostos e formatar data aos POSTS!
            foreach($posts as &$post){
                $id_post = $post['id_post'];
                $sql = Model::$BD->prepare("SELECT * FROM posts_gostos WHERE id_post = ?");
                $sql->execute([$id_post]);
                $num_gostos = $sql->rowCount();
                $post['gostos'] = $num_gostos;
                $post['data'] = date('d/m/Y',strtotime($post['data']));
            }
            // ADD comentarios aos POSTS!
            foreach($posts as &$post){
                $id_post = $post['id_post'];
                $sql = Model::$BD->prepare("SELECT * FROM posts_comentarios WHERE id_post = ?");
                $sql->execute([$id_post]);
                $num_comentarios = $sql->rowCount();
                $post['comentarios'] = $num_comentarios;
            }
            return $posts;
        }
    }


?>