<?php

    use Model\Usuario;
    use Model\Model;

    $Usuario = new Usuario();

    function getAllUsers(){
        global $Usuario;

        $dados = $Usuario->getAllUsers();
        Mostrar(false,'',$dados);
    }
    function cadastrar(){
        global $Usuario;

        extract($_POST) or extract($_GET);
        $Usuario->setInfo($nome,$genero,$num_tel,$senha);
        if($Usuario->cadastrar()){ //se cadastrou
            $dados_usuario = $Usuario->get_usuario_by_num_tel($num_tel);
            Mostrar(false,'Usuario salvo com sucesso',$dados_usuario);
        }else{
            Mostrar(true,'Já existe um usuario com este Número de telefone!',[]);
        }
    }
    function logar(){
        global $Usuario;

        extract($_POST) or extract($_GET);
        $dados = $Usuario->logar($num_tel,$senha);

        if($dados) Mostrar(false,'Login feito',$dados);
        else Mostrar(true,'O usuario inserido não existe',[]);
    }
    function verificar_se_ha_sessao(){
        global $Usuario;

        $id_usuario = $Usuario->verificar_se_ha_sessao();

        if($id_usuario){
            $dados_sessao = $Usuario->get_user_by_id($id_usuario);
            Mostrar(false,'Existe alguma sessao iniciada',$dados_sessao);
        }else{
            Mostrar(true,'Não existe nenhuma sessão iniciada',[]);
        }
    }
    function terminar_sessao(){
        global $Usuario;
        $Usuario->terminar_sessao();
        Mostrar(false,'Sessão terminada',[]);
    }
    function alterar_dados_usuario(){
        global $Usuario;

        extract($_POST) or extract($_GET);

        $res = $Usuario->alterar_dados_usuario($nome,$genero,$num_tel,$id_usuario);
        Mostrar(false,'Dados do usuario alterados',$res);
    }
    function get_user_by_id(){
        global $Usuario;

        extract($_POST) or extract($_GET);

        $res = $Usuario->get_user_by_id($id_usuario);
        Mostrar(false,'',$res);
    }
    function alterar_senha(){
        global $Usuario;

        extract($_POST) or extract($_GET);

        $res = $Usuario->alterar_senha($senha,$nova_senha,$id_usuario);
        Mostrar(false,'',$res);
    }
    function alterar_foto(){
        global $Usuario;

        extract($_POST) or extract($_GET);

        $file = $_FILES['foto']['tmp_name'];
        $nome = md5($id_usuario.date('Y/m/d H:i:s')).'.jpg';
        $destino = "../img/$nome";

        $res1 = move_uploaded_file($file,$destino);

        $res2 = $Usuario->alterar_foto($nome,$id_usuario);
        Mostrar(false,'',[$res1,$res2]);
    }

    $funcao();
    Model::Desconectar();
?>