<?php


    use Model\Model;
    use Model\Post_Comentarios;

    $Post_Comentarios = new Post_Comentarios();

    function comentar(){
        global $Post_Comentarios;

        extract($_POST) or extract($_GET);
        if($Post_Comentarios->comentar($id_usuario,$id_post,$conteudo)){
            Mostrar(false,'Comentário feito',[]);
        }else{
            Mostrar(true,'Precisas de iniciar sessao para comentar',[]);
        }
    }

    function listar(){
        global $Post_Comentarios;

        extract($_POST) or extract($_GET);

        $dados = $Post_Comentarios->listar();

        Mostrar(false,'',$dados);
    }
    function comentarios_recentes_de(){
        global $Post_Comentarios;

        extract($_POST) or extract($_GET);

        $res = $Post_Comentarios->comentarios_recentes_de($id_usuario);
        Mostrar(false,'',$res);
    }
    function eliminar(){
        global $Post_Comentarios;

        extract($_POST) or extract($_GET);
        $Post_Comentarios->eliminar($id_comentario);
        Mostrar(false,'Comentário deletado!',[]);
    }
    function editar(){
        global $Post_Comentarios;

        extract($_POST) or extract($_GET);
        $Post_Comentarios->editar($id_comentario,$conteudo);
        Mostrar(false,'Comentário editado com sucesso!',[]);
    }
    function buscar_comentarios_post(){
        global $Post_Comentarios;

        extract($_POST) or extract($_GET);
        $res = $Post_Comentarios->buscar_comentarios_post($id_post);
        Mostrar(false,'',$res);
    }

    $funcao();
    Model::Desconectar();
?>