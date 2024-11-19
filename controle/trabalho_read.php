<?php
   $t1 = new Trabalho();
   $resp['status']='ok';
if(isset($v1)){
    $t1->setId_trabalho($v1);
}   
   $resp['dados']=$t1->read();

 echo  json_encode($resp);
?>