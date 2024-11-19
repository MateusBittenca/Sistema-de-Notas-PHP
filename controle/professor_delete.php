<?php

$p1 = new Usuario();
$p1->setRegistro($v1);
if($p1->existe()==true){
    $resp['status']=$p1->delete();
    $resp['msg']="professor excluido com sucesso";
    $resp['dados'] = $p1;
}else{
    $resp['status']="erro";
    $resp['msg']="esse professor não existe";
    $resp['dados'] = $p1;
}

echo json_encode($resp);


?>