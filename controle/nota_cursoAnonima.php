<?php
   $a1 = new avaliacao();
   $resp['status']='ok';
   $resp['dados']=$a1->curso_anonimo();
    echo  json_encode($resp);
?>