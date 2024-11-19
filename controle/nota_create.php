<?php

$jsonRecebido = file_get_contents('php://input');

$objJson = json_decode($jsonRecebido);
$o1 = new avaliacao();

$o1 ->setIdAvalicao($objJson->id_avalicao);
$o1->setRegistro_prof($objJson->registroprof);
$o1->setNota_geral($objJson->notaGeral);
$o1->setObs($objJson->obs);
$o1->setTrabalhoID($objJson->id_trabalho);

$resp = array();    
if($o1->existe()==false){
    if($o1->nota()==true){      
            if($o1->estaLogado()== true){               
                $resp['status']='ok';
                $resp['msg']='avalicao de professor feita com sucesso!!!';
                $resp['Dados']=$o1;
            }else{
                $resp['status']='ok';
                $resp['msg']='avalicao anonima feita com sucesso';
                $resp['Dados']=$o1;         
            } 
    }
}else{
    $resp['status']='erro';
    $resp['msg']='ja existe uma avalicao com este id';
    $resp['Dados']=$o1;  
}
echo json_encode($resp);


?>