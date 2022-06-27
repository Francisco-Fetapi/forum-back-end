<?php

    use Model\Post;
    use Model\Model;

    $Post = new Post();

    function criar(){
        global $Post;
        extract($_POST) or extract($_GET);

        $Post->criar($titulo,$conteudo,$id_usuario);
        Mostrar(false,'Post criado com sucesso',[]);
    }
    function listar(){
        global $Post;
        $posts = $Post->listar();

        Mostrar(false,'',$posts);
    }
    function eliminar(){
        global $Post;
        extract($_POST) or extract($_GET);

        if($Post->eliminar($id_post)){
            Mostrar(false,'Post eliminado!',[]);
        }else{
            Mostrar(true,'Erro ao eliminar!',[]);
        }
    }
    function editar(){
        global $Post;
        extract($_POST) or extract($_GET);

        $Post->editar($titulo,$conteudo,$id);
        Mostrar(false,'Post editado',[]);
        
    }

    function ultimos_posts(){
        global $Post;
        extract($_POST) or extract($_GET);
        
        $res = $Post->ultimos_posts($id_usuario);

        Mostrar(false,'',$res);
    }
    function buscar_dados_post(){
        global $Post;
        extract($_POST) or extract($_GET);

        $res = $Post->buscar_dados_post($id_post);

        Mostrar(false,'',$res);
    }
    function obter_todos_os_posts(){
        global $Post;
        extract($_POST) or extract($_GET);

        $res = $Post->obter_todos_os_posts();

        Mostrar(false,'',$res);
    }
    function filtrar_posts(){
        global $Post;
        extract($_POST) or extract($_GET);

        $res = $Post->filtrar_posts($query);

        Mostrar(false,'',$res);
    }
    $funcao();
    Model::Desconectar();
?>