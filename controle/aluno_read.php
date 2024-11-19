<?php
   $a1 = new Aluno();
   $resp['status']='ok';
if(isset($v1)){
    $a1->setMatricula($v1);
}   
   $resp['dados']=$a1->read();

 echo  json_encode($resp);
?>