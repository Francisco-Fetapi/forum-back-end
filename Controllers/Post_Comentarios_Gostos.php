<?php

    use Model\Post_Comentarios_Gostos;
    use Model\Model;

    $Post_Comentarios_Gostos = new Post_Comentarios_Gostos();

    function likar(){
        global $Post_Comentarios_Gostos;
        
        extract($_GET) or extract($_POST);
        $Post_Comentarios_Gostos->likar($id_usuario,$id_comentario);
        Mostrar(false,'Comentário gostado',[]);
    }
    function dislikar(){
        global $Post_Comentarios_Gostos;
        
        extract($_GET) or extract($_POST);
        if($Post_Comentarios_Gostos->dislikar($id_comentario)){
            Mostrar(false,'O gosto do comentario foi retirado!',[]);
        }else{
            Mostrar(true,'Precisa se logar para dar dislike neste comentario');
        }
    }
    function listar(){
        global $Post_Comentarios_Gostos;

        $gostos = $Post_Comentarios_Gostos->listar();
        Mostrar(false,'',$gostos);
    }
    function ja_likou(){
        global $Post_Comentarios_Gostos;
        extract($_GET) or extract($_POST);
        $gostou = $Post_Comentarios_Gostos->ja_likou($id_usuario,$id_comentario);
        Mostrar(false,'',$gostou);
    }

    $funcao();
    Model::Desconectar();
?>