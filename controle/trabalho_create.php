<?php

$jsonRecebido = file_get_contents('php://input');

$objJson = json_decode($jsonRecebido);
$t1 = new Trabalho();

$t1->setId_trabalho($objJson->id_trabalho);
$t1->setNomeTrabalho($objJson->nomeTrabalho);
$t1->setResumo($objJson->resumo);
$t1->setIdCurso($objJson->idCurso);

$resp = array();    
 
    if($t1->existe() == false){ 
        if($t1->create()==true){
            $resp['status']='ok';
            $resp['msg']='cadastrado com sucesso';
            $resp['Dados']=$t1;
        }else{
            $resp['status']='erro';
            $resp['msg']='nao foi possivel cadastrar o trabalho';
            $resp['Dados']=$t1;
        }
    }else{
        $resp['status']='erro';
        $resp['msg']='ja existe um trabalho com esse ID';
        $resp['Dados']=$t1;  
    } 

echo json_encode($resp);



?>