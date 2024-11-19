<?php
$u1 = new Usuario();
$u1->estaLogado();
$resp['status']='ok';
$resp['msg'] = $u1->estaLogado();
echo json_encode($resp);
?>