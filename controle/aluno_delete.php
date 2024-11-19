<?php

$a1 = new Aluno();
$a1->setMatricula($v1);
if($a1->existe()==true){
    $resp['status']=$a1->delete();
    $resp['msg']="aluno excluido com sucesso";
    $resp['dados'] = $a1;
}else{
    $resp['status']='erro';
    $resp['msg']="esse aluno não existe";
    $resp['dados'] = $a1;

}

echo json_encode($resp);


?>