<?php
   $a1 = new avaliacao();
   $resp['status']='ok';
   $resp['msg']='Melhor trabalho da galera';
   $resp['dados']=$a1->listarTrabalhoAnonimo();
    echo  json_encode($resp);
?>