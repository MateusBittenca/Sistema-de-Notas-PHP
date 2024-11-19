<?php
   $a1 = new avaliacao();
   $resp['status']='ok';
   $resp['dados']=$a1->alfabetica();
    echo  json_encode($resp);
?>