<?php
require_once "banco.php";

class Aluno implements JsonSerializable{
private $id_trabalho;
private $matricula;
private $nomeAluno;
private $turma;

public function jsonSerialize(){
    $array = array();
    $array['idTrabalho'] = $this->getId_trabalho();
    $array['matricula'] = $this->getMatricula();
    $array['nomeAluno'] = $this->getNomeAluno();
    $array['turma'] = $this->getTurma();
    return $array;
}
public function create(){
    
    $sql = 'INSERT INTO alunosgrupo (Trabalho_idTrabalho,matriculaAluno,nomeAluno,turmaAluno) VALUES (?,?,?,?)';
    $stmt = Banco::getConexao()->prepare($sql);
    
    $idTrabalho = $this->getId_trabalho();
    $matricula = $this->getMatricula();
    $nome = $this->getNomeAluno();
    $turma = $this->getTurma();

   
    $stmt->bind_param("isss",$idTrabalho,$matricula,$nome,$turma);
    return $stmt->execute();
}  
public function existe(){ 
    $sql = 'SELECT COUNT(*) AS matriculaAluno FROM alunosgrupo WHERE matriculaAluno = ?';
    $stmt = Banco::getConexao()->prepare($sql);
    $matricula = $this->getMatricula(); 
 
    $stmt->bind_param("s", $matricula);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $linha = $resultado->fetch_object();
    if($linha->matriculaAluno == true){
      
        return true;
    }
    return false;
} 
public function delete(){
    $sql = "DELETE FROM alunosgrupo WHERE matriculaAluno = ?";
    $stmt = Banco::getConexao()->prepare($sql);

    $matricula = $this->getMatricula();

    $stmt->bind_param("s",$matricula);
    return $stmt->execute();
} 
public function read(){
    $matricula = $this->getMatricula();    
    if($matricula==""){  
        $sql = 'SELECT * FROM alunosgrupo';
        $stmt = Banco::getConexao()->prepare($sql);  
    }else{
        $sql = 'SELECT * FROM alunosgrupo WHERE matriculaAluno = ?';
        $stmt = Banco::getConexao()->prepare($sql);
        $stmt->bind_param('s',$matricula);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();
    $aluno = array();
    $i=0;
    while($linha = $resultado->fetch_object()){
        $aluno[$i] = new Aluno();    
        
       
        $aluno[$i]->setMatricula($linha->matriculaAluno);
        $aluno[$i]->setNomeAluno($linha->nomeAluno);  
        $aluno[$i]->setTurma($linha->turmaAluno);       
        $i++;
    }
    return $aluno;
}

 



/**
 * Get the value of id_trabalho
 */ 
public function getId_trabalho()
{
return $this->id_trabalho;
}

/**
 * Set the value of id_trabalho
 *
 * @return  self
 */ 
public function setId_trabalho($id_trabalho)
{
$this->id_trabalho = $id_trabalho;

return $this;
}

/**
 * Get the value of matricula
 */ 
public function getMatricula()
{
return $this->matricula;
}

/**
 * Set the value of matricula
 *
 * @return  self
 */ 
public function setMatricula($matricula)
{
$this->matricula = $matricula;

return $this;
}

/**
 * Get the value of nomeAluno
 */ 
public function getNomeAluno()
{
return $this->nomeAluno;
}

/**
 * Set the value of nomeAluno
 *
 * @return  self
 */ 
public function setNomeAluno($nomeAluno)
{
$this->nomeAluno = $nomeAluno;

return $this;
}

/**
 * Get the value of turma
 */ 
public function getTurma()
{
return $this->turma;
}

/**
 * Set the value of turma
 *
 * @return  self
 */ 
public function setTurma($turma)
{
$this->turma = $turma;

return $this;
}
}

?>