<?php

    namespace Model;

    session_start();
    class Post_Comentarios extends Model{

        public function __construct(){
            parent::Conectar();
        }
        public function comentar($id_usuario,$id_post,$conteudo){
                $usuario_id = $id_usuario ?? $_SESSION['id_usuario'];
                $sql = Model::$BD->prepare("INSERT INTO posts_comentarios VALUES(DEFAULT,?,?,?,NOW())");
                $sql->execute([$usuario_id,$id_post,$conteudo]);

                return true;
        }
        public function listar(){
            $sql = Model::$BD->query("SELECT * FROM posts_comentarios");
            $sql = $sql->fetchAll(\PDO::FETCH_ASSOC);

            return $sql;
        }
        public function comentarios_recentes_de($id_usuario){
            $sql = Model::$BD->prepare("SELECT c.id as 'id_comentario',c.id_post,c.conteudo,u.nome,p.titulo as titulo_post FROM 
            posts_comentarios as c JOIN usuarios as u ON u.id = c.id_usuario 
            JOIN posts as p ON p.id = c.id_post 
            WHERE c.id_usuario = ? ORDER BY c.id DESC LIMIT 3");
            $sql->execute([$id_usuario]);

            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
        public function eliminar($id_post_comentario){
            $sql = Model::$BD->prepare("DELETE FROM posts_comentarios WHERE id = ?");
            $sql->execute([$id_post_comentario]);

            // Eliminar os gostos do comentario
            $sql = Model::$BD->prepare("DELETE FROM posts_comentarios_gostos WHERE id_comentario = ?");
            $sql->execute([$id_post_comentario]);

            return true;
        }
        public function editar($id_comentario,$conteudo){
            $sql = Model::$BD->prepare("UPDATE posts_comentarios SET conteudo = ? WHERE id = ?");
            $sql->execute([$conteudo,$id_comentario]);
            return true;
        }
        public function buscar_comentarios_post($id_post){
            $sql = Model::$BD->prepare("SELECT 
            u.id as 'id_usuario',u.nome,u.foto,pc.conteudo,pc.data,pc.id,count(pcg.id)
            as 'gostos' FROM posts_comentarios pc
            LEFT JOIN usuarios u ON u.id = pc.id_usuario
            LEFT JOIN posts_comentarios_gostos pcg 
            ON pc.id = pcg.id_comentario 
            WHERE id_post = ? GROUP BY pc.id ");
            $sql->execute([$id_post]);

            $comentarios = $sql->fetchAll(\PDO::FETCH_ASSOC);

            foreach($comentarios as &$comentario){
                $comentario['data'] = date('d/m/Y',strtotime($comentario['data']));
            }

            return $comentarios;
        }
    }

?>