<?php

$t1 = new Trabalho();
$t1->setId_trabalho($v1);
if($t1->existe()==true){
    $resp['status']=$t1->delete();
    $resp['msg']="trabalho excluido com sucesso";
    

}else{
    $resp['status']="erro";
    $resp['msg']="esse trabalho não existe";
    
}

echo json_encode($resp);
?>