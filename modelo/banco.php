<?php
    class Banco{
        private static $HOST='127.0.0.1';
        private static $USUARIO = 'root';
        private static $SENHA = '';
        private static $BANCO ='feitatecnica';
        private static $PORTA ='3306';
        private static $CON = null;
        public static function getConexao(){
            if(Banco::$CON==null){
                Banco::$CON = new mysqli(Banco::$HOST,Banco::$USUARIO,Banco::$SENHA,Banco::$BANCO,Banco::$PORTA);
            }
            return Banco::$CON;
        }

    }
    

?>