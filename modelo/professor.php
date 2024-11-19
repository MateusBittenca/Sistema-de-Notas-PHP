<?php
require_once "banco.php";
    class Usuario implements JsonSerializable{
        private $registro;
        private $nome;   
        private $nascimento;
       
        public function jsonSerialize(){ 
            $array = array();
            
            $array['registro'] = $this->getRegistro();
            $array['nome'] = $this->getNome();
            $array['nascimento'] = $this->getNascimento();           
            return $array;
        } 
        public function login(){ 

            $sql = 'SELECT COUNT(*) AS registro,nome,nascimento FROM professor WHERE registro = ?';
            $stmt = Banco::getConexao()->prepare($sql);
            $registro = $this->getRegistro();
            
            $stmt->bind_param("i",$registro); 
            $stmt->execute(); 
            $resultado = $stmt->get_result();
            
            $linha = $resultado->fetch_object();
            if($linha->registro == true){ 
                $this->setNome($linha->nome);
                $_SESSION['logado'] = true;
                $_SESSION['registro'] = $linha->registro;
                $_SESSION['nome'] = $linha->nome;
                $_SESSION['nascimento'] = $linha->nascimento;
                return true;
            }
            return false;
         }
        public function existe(){
            $sql = 'SELECT COUNT(*) AS registro FROM professor WHERE registro = ?';
            $stmt = Banco::getConexao()->prepare($sql);
            $registro=$this->getRegistro();
            $stmt->bind_param("i", $registro);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $linha = $resultado->fetch_object();
            if($linha->registro == true){ 
                return true;
            }
            return false;
        }
        public function delete(){
            $sql = "DELETE FROM professor WHERE registro = ?";
            $stmt = Banco::getConexao()->prepare($sql);
        
            $registro = $this->getRegistro();
        
            $stmt->bind_param("i",$registro);
            return $stmt->execute();  
        }
        public function read(){
            $registro = $this->getRegistro();
            if($registro==""){  
                $sql = 'SELECT * FROM professor';
                $stmt = Banco::getConexao()->prepare($sql);  
            }else{
                $sql = 'SELECT * FROM professor WHERE registro = ?';
                $stmt = Banco::getConexao()->prepare($sql);
                $stmt->bind_param('i',$registro);
            }
            $stmt->execute();
            $resultado = $stmt->get_result();
            $professores = array();
            $i=0;
            while($linha = $resultado->fetch_object()){
                $professores[$i] = new Usuario();
                $professores[$i]->setRegistro($linha->registro);
                $professores[$i]->setNome($linha->nome);
                $professores[$i]->setNascimento($linha->nascimento);          
                $i++;
            }
            return $professores;
        }
        
        public function create(){

            $sql = 'INSERT INTO professor (registro,nome,nascimento) VALUES (?,?,?)';
            $stmt = Banco::getConexao()->prepare($sql);
            $registro = $this->getRegistro();
            $nome = $this->getNome();
            $nascimento = $this->getNascimento();

            $stmt->bind_param("iss",$registro,$nome,$nascimento);
            return $stmt->execute();
 
        }
              
        public function estaLogado(){

            if(isset($_SESSION['logado'])==true){
                if($_SESSION['logado']== true){
                    return true;
                }
            }else{
                return false;
            }
            return false;
        }

        public function logout(){
            session_unset();
            session_destroy();            
        }
       
        public function getNome()
        {
                return $this->nome;
        }

        /**
         * Set the value of nome
         *
         * @return  self
         */ 
        public function setNome($nome)
        {
                $this->nome = $nome;

                return $this;
        }

       

        /**
         * Get the value of registro
         */ 
      
        /**
         * Get the value of nascimento
         */ 
        public function getNascimento()
        {
                return $this->nascimento;
        }

        /**
         * Set the value of nascimento
         *
         * @return  self
         */ 
        public function setNascimento($nascimento)
        {
                $this->nascimento = $nascimento;

                return $this;
        }

      

        /**
         * Get the value of registro
         */ 
        public function getRegistro()
        {
                return $this->registro;
        }

        /**
         * Set the value of registro
         *
         * @return  self
         */ 
        public function setRegistro($registro)
        {
                $this->registro = $registro;

                return $this;
        }

        /**
         * Get the value of idAvalicao
         */ 
         
    }
?>