<?php

    function Mostrar($falha=false,$msg='',$dados=[],$tempo = 3){
        echo json_encode([
            'falha'=>$falha,
            'msg'=>$msg,
            'dados'=>$dados,
            'tempo'=>$tempo
        ]);
    }

?>