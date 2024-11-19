<?php
  $u1 = new Usuario();
  $u1->logout();
  $resp['status']='ok';
  $resp['msg'] = 'Deslogado com sucesso';
  echo json_encode($resp);
?>