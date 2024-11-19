<?php
$jsonRecebido = file_get_contents('php://input');

$objJson = json_decode($jsonRecebido);
$u1 = new Usuario();

$u1->setRegistro($objJson->registro);
$u1->setNome($objJson->nome);
$u1->setNascimento($objJson->nascimento);

$resp = array();    
if($u1->estaLogado() == true){   
    if($u1->existe()== false){ 
        if($u1->create()==true){
            $resp['status']='ok';
            $resp['msg']='cadastrado com sucesso';
            $resp['Dados']=$u1;
        }else{
            $resp['status']='erro';
            $resp['msg']='nao foi possivel cadastrar o usuario';
            $resp['Dados']=$u1;
        }
    }else{
        $resp['status']='erro';
        $resp['msg']='ja existe um usuario com esse registro';
        $resp['Dados']=$u1;  
    } 
}else{
    $resp['status']='erro';
    $resp['msg']='voce não possui autorização para cadastrar usuarios';
    $resp['Dados']=$u1;
}  
echo json_encode($resp);



?>