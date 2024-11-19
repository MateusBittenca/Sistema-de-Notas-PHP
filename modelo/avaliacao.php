<?php
require_once "banco.php";
class avaliacao implements JsonSerializable{
    private $idAvalicao;
    private $nota_geral;
    private $obs;
    private $trabalhoID;
    private $registro_prof;
public function jsonSerialize(){
    $array['idAvaliacao'] = $this->getIdAvalicao();
    $array['registroprof']=$this->getRegistro_prof();
    $array['nota'] = $this->getNota_geral(); 
    $array['obs'] = $this->getObs();
    $array['trabalhoID'] = $this->getTrabalhoID();
    return $array;
}
public function read(){
    $id = $this->getIdAvalicao();    
    if($id==""){  
        $sql = 'SELECT * FROM avaliacao';
        $stmt = Banco::getConexao()->prepare($sql);  
    }else{
        $sql = 'SELECT * FROM avaliacao WHERE idAvaliacao = ?';
        $stmt = Banco::getConexao()->prepare($sql);
        $stmt->bind_param('i',$id);
    } 
    $stmt->execute();
    $resultado = $stmt->get_result();
    $aluno = array();
    $i=0;
    while($linha = $resultado->fetch_object()){
        $aluno[$i] = new avaliacao();            
        $aluno[$i]->setIdAvalicao($linha->idAvaliacao);
        $aluno[$i]->setRegistro_prof($linha->professor_registro);
        $aluno[$i]->setNota_geral($linha->notaGeral);
        $aluno[$i]->setObs($linha->obs);
        $aluno[$i]->setTrabalhoID($linha->Trabalho_idTrabalho);           
        $i++;
    }
    return $aluno;
}
public function existe(){
    $sql = 'SELECT COUNT(*) AS idAvaliacao FROM avaliacao WHERE  idAvaliacao = ? ';
    $stmt = Banco::getConexao()->prepare($sql);      
    $registro = $this->getIdAvalicao();  
    $stmt->bind_param("i",$registro);  
    $stmt->execute();     
    $resultado = $stmt->get_result();
    $linha = $resultado->fetch_object();  
    if($linha->idAvaliacao > 0){ 
        return true;
    }
    return false;
}
public function nota(){ 
    $a1 = new avaliacao;
    $idavalicao = $this->getIdAvalicao();   
    $registro = $this->getRegistro_prof();  
    $nota = $this->getNota_geral();
    $obs = $this->getObs();
    $idtrabalho = $this->getTrabalhoID();
    if($a1->estaLogado()==true){
        $sql = 'INSERT INTO avaliacao (idAvaliacao,professor_registro,notaGeral,obs,Trabalho_idTrabalho) VALUES (?,?,?,?,?)';
        $stmt = Banco::getConexao()->prepare($sql);
        $stmt->bind_param("iiisi",$idavalicao,$registro,$nota,$obs,$idtrabalho);
    }else{
        $sql = 'INSERT INTO avaliacao (idAvaliacao,notaGeral,obs,Trabalho_idTrabalho) VALUES (?,?,?,?)';
        $stmt = Banco::getConexao()->prepare($sql);
        $stmt->bind_param("iisi",$idavalicao,$nota,$obs,$idtrabalho);
     }  
    return  $stmt->execute();
}
public function listarTrabalhoAnonimo()
    {
        $sql ='SELECT * FROM avaliacao WHERE notaGeral = (SELECT MAX(notaGeral) FROM avaliacao) AND professor_registro IS NULL';
        $stmt = Banco::getConexao()->prepare($sql);
        $stmt->execute();
        $resposta = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $resposta;
    } 
public function listarAvaliacao(){
        $sql ='SELECT * FROM avaliacao WHERE professor_registro IS NOT NULL ORDER BY notaGeral DESC LIMIT 10';   
        $stmt = Banco::getConexao()->prepare($sql);       
        $stmt->execute();
        $resposta = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $resposta;
}  
public function curso_anonimo(){
    $sql = 'SELECT avaliacao.notaGeral,professor_registro,curso.idCurso FROM avaliacao INNER JOIN trabalho ON avaliacao.Trabalho_idTrabalho = trabalho.idTrabalho JOIN curso ON curso.idCurso = trabalho.Curso_idCurso WHERE professor_registro IS NULL AND notaGeral = (SELECT MAX(notaGeral) FROM avaliacao) ORDER BY idCurso ';
    $stmt =Banco::getConexao()->prepare($sql);
    $stmt->execute();
    $resposta = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $resposta; 
}   
public function alfabetica(){
    $sql = 'SELECT avaliacao.notaGeral,curso.idCurso,nomeCurso,trabalho.nomeTrabalho FROM avaliacao INNER JOIN trabalho ON avaliacao.Trabalho_idTrabalho = trabalho.idTrabalho JOIN curso ON curso.idCurso = trabalho.Curso_idCurso WHERE professor_registro IS NOT NULL ORDER BY idCurso,nomeTrabalho  ';
    $stmt =Banco::getConexao()->prepare($sql);
    $stmt->execute();
    $resposta = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $resposta;
}  
public function ordem_nota(){
    $sql = 'SELECT avaliacao.notaGeral,professor_registro,curso.idCurso FROM avaliacao  INNER JOIN trabalho ON avaliacao.Trabalho_idTrabalho = trabalho.idTrabalho JOIN curso ON curso.idCurso = trabalho.Curso_idCurso WHERE professor_registro  IS NOT NULL ORDER BY idCurso,notaGeral DESC ';
    $stmt = Banco::getConexao()->prepare($sql);
    $stmt->execute();
    $resposta = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $resposta;
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

    /**
     * Get the value of idAvalicao
     */ 
    public function getIdAvalicao()
    {
        return $this->idAvalicao;
    }

    /**
     * Set the value of idAvalicao
     *
     * @return  self
     */ 
    public function setIdAvalicao($idAvalicao)
    {
        $this->idAvalicao = $idAvalicao;

        return $this;
    }

    /**
     * Get the value of nota_geral
     */ 
    public function getNota_geral()
    {
        return $this->nota_geral;
    }

    /**
     * Set the value of nota_geral
     *
     * @return  self
     */ 
    public function setNota_geral($nota_geral)
    {
        $this->nota_geral = $nota_geral;

        return $this;
    }

    /**
     * Get the value of obs
     */ 
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * Set the value of obs
     *
     * @return  self
     */ 
    public function setObs($obs)
    {
        $this->obs = $obs;

        return $this;
    }

    /**
     * Get the value of trabalhoID
     */ 
    public function getTrabalhoID()
    {
        return $this->trabalhoID;
    }

    /**
     * Set the value of trabalhoID
     *
     * @return  self
     */ 
    public function setTrabalhoID($trabalhoID)
    {
        $this->trabalhoID = $trabalhoID;

        return $this;
    }

    /**
     * Get the value of registro_prof
     */ 
    public function getRegistro_prof()
    {
        return $this->registro_prof;
    }

    /**
     * Set the value of registro_prof
     *
     * @return  self
     */ 
    public function setRegistro_prof($registro_prof)
    {
        $this->registro_prof = $registro_prof;

        return $this;
    }
}

?>