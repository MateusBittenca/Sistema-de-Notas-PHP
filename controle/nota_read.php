<?php
   $a1 = new avaliacao();
   $resp['status']='ok';
     
if(isset($v1)){
    $a1->setIdAvalicao($v1);
}   
   $resp['dados']=$a1->read();

 echo  json_encode($resp);
?>