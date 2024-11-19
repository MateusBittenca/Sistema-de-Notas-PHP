<?php
require_once "banco.php";
class Trabalho implements JsonSerializable{
private $id_trabalho;
private $nomeTrabalho;
private $resumo;
private $idCurso;

public function jsonSerialize(){
    $array = array();
    $array['idTrabalho'] = $this->getId_trabalho();
    $array['nomeTrabalho'] = $this->getNomeTrabalho();
    $array['resumo'] = $this->getResumo();
    $array['idCurso'] = $this->getIdCurso();
    return $array;
}
 
  
public function existe(){
    $sql = 'SELECT COUNT(*) AS idTrabalho FROM trabalho WHERE idTrabalho = ?';
    $stmt = Banco::getConexao()->prepare($sql);
    $idTrabalho = $this->getId_trabalho();

    $stmt->bind_param("i", $idTrabalho);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $linha = $resultado->fetch_object();
    if($linha->idTrabalho == true){
      
        return true;
    }
    return false;


}
public function delete(){
    $sql = "DELETE FROM trabalho WHERE idTrabalho = ?";
    $stmt = Banco::getConexao()->prepare($sql);

    $idTrabalho = $this->getId_trabalho(); 
 
    $stmt->bind_param("i",$idTrabalho); 
    return $stmt->execute();




 
} 
public function read(){ 
    $idTrabalho = $this->getId_trabalho();    
    if($idTrabalho==""){  
        $sql = 'SELECT * FROM trabalho';
        $stmt = Banco::getConexao()->prepare($sql);  
    }else{
        $sql = 'SELECT * FROM trabalho WHERE idTrabalho = ?';
        $stmt = Banco::getConexao()->prepare($sql);
        $stmt->bind_param('s',$idTrabalho);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();
    $trabalho = array();
    $i=0;
    while($linha = $resultado->fetch_object()){
        $trabalho[$i] = new Trabalho();    
         
        $trabalho[$i]->setId_trabalho($linha->idTrabalho);
        $trabalho[$i]->setNomeTrabalho($linha->nomeTrabalho);
        $trabalho[$i]->setResumo($linha->resumo);  
        $trabalho[$i]->setIdCurso($linha->Curso_idCurso);       
        $i++;
    }
    return $trabalho;
}
public function create(){

    $sql = 'INSERT INTO trabalho (idTrabalho,nomeTrabalho,resumo,Curso_idCurso) VALUES (?,?,?,?)';
    $stmt = Banco::getConexao()->prepare($sql);

    $idTrabalho = $this->getId_trabalho();
    $nomeTrabalho = $this->getNomeTrabalho();
    $resumo = $this->getResumo();
    $Curso_idCurso = $this->getIdCurso();

    $stmt->bind_param("issi",$idTrabalho,$nomeTrabalho,$resumo,$Curso_idCurso);
    
    return $stmt->execute();

}
public function alfabetica(){
    $sql = 'SELECT * FROM trabalho ORDER BY nomeTrabalho ';
    $stmt =Banco::getConexao()->prepare($sql);
    $stmt->execute();
    $resposta = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $resposta;
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
 * Get the value of nomeTrabalho
 */ 
public function getNomeTrabalho()
{
return $this->nomeTrabalho;
}

/**
 * Set the value of nomeTrabalho
 *
 * @return  self
 */ 
public function setNomeTrabalho($nomeTrabalho)
{
$this->nomeTrabalho = $nomeTrabalho;

return $this;
}

/**
 * Get the value of resumo
 */ 
public function getResumo()
{
return $this->resumo;
}

/**
 * Set the value of resumo
 *
 * @return  self
 */ 
public function setResumo($resumo)
{
$this->resumo = $resumo;

return $this;
}

/**
 * Get the value of idCurso
 */ 
public function getIdCurso()
{
return $this->idCurso;
}

/**
 * Set the value of idCurso
 *
 * @return  self
 */ 
public function setIdCurso($idCurso)
{
$this->idCurso = $idCurso;

return $this;
}
}

?>