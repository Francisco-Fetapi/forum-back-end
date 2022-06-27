<?php

    use Model\Post_Gostos;
    use Model\Model;

    $Post_Gostos = new Post_Gostos();

    function likar(){
        global $Post_Gostos;
        
        extract($_GET) or extract($_POST);
        $Post_Gostos->likar($id_usuario,$id_post);
        Mostrar(false,'Post gostado',['id_usuario'=>$id_usuario,'id_post'=>$id_post]);
        
    }
    function dislikar(){
        global $Post_Gostos;
        
        extract($_GET) or extract($_POST);
        if($Post_Gostos->dislikar($id_post)){
            Mostrar(false,'O gosto do post foi retirado!',[]);
        }else{
            Mostrar(true,'Precisa se logar para dar dislike neste Post');
        }
    }
    function listar(){
        global $Post_Gostos;

        $gostos = $Post_Gostos->listar();
        Mostrar(false,'',$gostos);
    }
    function ja_likou(){
        global $Post_Gostos;
        extract($_GET) or extract($_POST);
        $res = $Post_Gostos->ja_likou($id_usuario,$id_post);
        Mostrar(false,'',$res);
    }

    $funcao();
    Model::Desconectar();
?>