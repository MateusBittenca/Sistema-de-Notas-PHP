<?php
    session_start();
    require_once "modelo/trabalho.php";
    require_once "modelo/professor.php";
    require_once "modelo/Router.php";
    require_once "modelo/aluno.php";
    require_once "modelo/avaliacao.php";
   

        $rota = new Router();


        $rota->post('/professor',function(){
            require_once "controle/professor_create.php";
         });

         $rota->get('/professor',function(){
            require_once "controle/professor_read.php";
         });

         $rota->get('/professor/([^/]+)',function($v1){
           
            require_once "controle/professor_read.php";
         });
         $rota->delete('/professor/([^/]+)',function($v1){
            require_once "controle/professor_delete.php";
         });
  
        $rota->post('/login',function(){
           require_once "controle/professor_login.php";
        });
        
        $rota->get('/estalogado',function(){
            require_once "controle/professor_estalogado.php";
         });

        $rota->get('/logout',function(){
            require_once "controle/professor_logout.php";
        });

        $rota->post('/trabalho',function(){
         require_once "controle/trabalho_create.php";
        });

        $rota->get('/trabalho',function(){
         require_once "controle/trabalho_read.php";
         });

         $rota->get('/trabalho/([^/]+)',function($v1){
          require_once "controle/trabalho_read.php";
        });


        $rota->delete('/trabalho/([^/]+)',function($v1){
            require_once "controle/trabalho_delete.php";
        });
        $rota->post('/aluno',function(){
         require_once "controle/aluno_create.php";
        });

        $rota->delete('/aluno/([^/]+)',function($v1){
            require_once "controle/aluno_delete.php";

        });

        $rota->get('/aluno',function(){
         require_once "controle/aluno_read.php";
        });
         $rota->get('/aluno/([^/]+)',function($v1){
            require_once "controle/aluno_read.php";
        });

        $rota->post('/nota',function(){
            require_once "controle/nota_create.php";

        });
       
        $rota->get('/nota',function(){
            require_once "controle/nota_read.php";
         });
         $rota->get('/nota/([^/]+)',function($v1){
               require_once "controle/nota_read.php";
         });
         $rota->get('/maior',function(){
            require_once "controle/avaliacao_maior.php";
         });
         $rota->get('/listar',function(){
            require_once "controle/listar.php";
         });
         $rota->get('/alfa',function(){
            require_once "controle/trabalho_alfabetico.php";
        });
        $rota->get('/cursoa',function(){
            require_once "controle/nota_cursoAnonima.php";
        });
        $rota->get('/mostrar',function(){
            require_once "controle/mostar_notaCurso.php";
        });
        $rota->run();



?>