<?php

$jsonRecebido = file_get_contents('php://input');

$objJson = json_decode($jsonRecebido);
$a1 = new Aluno();
$a1->setId_trabalho($objJson->id_trabalho);
$a1->setMatricula($objJson->matricula);
$a1->setNomeAluno($objJson->nomeAluno);
$a1->setTurma($objJson->turma);

$resp = array();    
 
    if($a1->existe() == false){ 
        if($a1->create()==true){
            $resp['status']='ok';
            $resp['msg']='cadastrado com sucesso';
            $resp['Dados']=$a1;
        }else{
            $resp['status']='erro';
            $resp['msg']='nao foi possivel cadastrar o aluno';
            $resp['Dados']=$a1;
        }
    }else{
        $resp['status']='erro';
        $resp['msg']='ja existe um aluno com esse ID';
        $resp['Dados']=$a1;  
    }
echo json_encode($resp);
?>