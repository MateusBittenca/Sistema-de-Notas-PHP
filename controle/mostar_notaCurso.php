<?php
   $a1 = new avaliacao();
   $resp['status']='ok';
   $resp['dados']=$a1->ordem_nota();
    echo  json_encode($resp);
?>