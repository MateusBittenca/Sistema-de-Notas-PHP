<?php
   $p1 = new Usuario();
   $resp['status']='ok';
if(isset($v1)){
    $p1->setRegistro($v1);
}   
   $resp['dados']=$p1->read();

 echo  json_encode($resp);
?>