<?php
$jsonRecebido = file_get_contents('php://input');

$objJson = json_decode($jsonRecebido);
$u1 = new Usuario();
$u1->setRegistro($objJson->registro);           
if($u1->login()==true){
   $resp = array();
   $resp['status']='ok';
   $resp['msg']='Logado com sucesso';
   $resp['Dados']=$u1;
}else{
    $resp['status']='erro';
    $resp['msg']='erro ao efetuar login';
    $resp['Dados']=$u1;
}
echo json_encode($resp);

?>