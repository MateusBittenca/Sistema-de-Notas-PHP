<?php
   $a1 = new avaliacao();
   $resp['status']='ok';
   $resp['dados']=$a1->listarAvaliacao();
    echo  json_encode($resp);
?>