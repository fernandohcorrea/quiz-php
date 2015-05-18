<?php

abstract class Documento {
    
    protected $documento;
    
    function __construct($documento = NULL)
    {
        $this->documento = $documento;
    }
    
    function getDocumento(){
        return $this->documento;
    }

    function setDocumento($documento){
        $this->documento = $documento;
    }
        
    public function __toString()
    {
        return preg_filter('/\D/', '', $this->documento);
    }

}

final class DocumentoCPF extends Documento{ /** Implementações **/}

final class DocumentoCNPJ extends Documento { /** Implementações **/}

abstract class Pessoa
{
    protected $nome;
    protected $documento;

    function __construct($nome = NULL, \Documento $documento = NULL ){
        $this->nome = $nome;
        $this->documento = $documento;
    }
    
    function getNome(){
        return $this->nome;
    }

    function getDocumento(){
        return $this->documento;
    }

    function setNome($nome){
        $this->nome = $nome;
        return $this;
    }

    function setDocumento(\Documento $documento){
        $this->documento = $documento;
        return $this;
    }

}

interface PessoaInterface
{
    public function getId();
}

final class PessoaFisica extends Pessoa implements \PessoaInterface {
    
    function __construct($nome = NULL, \DocumentoCPF $documento = NULL){
        parent::__construct($nome, $documento);
    }
    
    public function setDocumento(\Documento $documento = NULL){
        if(!$documento instanceof \DocumentoCPF){
            throw new InvalidArgumentException('Objeto Documento inválido', 500);
        }
        return parent::setDocumento($documento);
    }
    
    public function getId(){
        return md5($this->nome . $this->documento);
    }

}

final class PessoaJuridica extends Pessoa implements \PessoaInterface {
    
    function __construct($nome = NULL, \DocumentoCNPJ $documento = NULL){
        parent::__construct($nome, $documento);
    }
    
    public function setDocumento(\Documento $documento = NULL){
        if(!$documento instanceof \DocumentoCNPJ){
            throw new InvalidArgumentException('Objeto Documento inválido', 500);
        }
        return parent::setDocumento($documento);
    }
    
    public function getId(){
        return md5($this->nome . $this->documento);
    }
}

final class GenPessoa
{
    private static $instance;
    
    private function __construct(){}
    
    public static function getInstance()
    {
        $cls = __CLASS__;
        
        if(!is_object(self::$instance) && !(self::$instance instanceof $cls) ){
            self::$instance = new $cls();
        }
        
        return self::$instance;
    }

    public function genPessoaByDocumento($nome, \Documento $documento){
        $docInstanceOf = get_class($documento);
        $pessoa = NULL;
        switch (strtoupper($docInstanceOf)) {
            case 'DocumentoCPF':
                $pessoa = new \PessoaFisica($nome, $documento);
                break;
            
            case 'DOCUMENTOCNPJ':
                $pessoa = new \PessoaJuridica($nome, $documento);
                break;

            default:
                throw new InvalidArgumentException('Objeto Documento inválido', 500);
        
        }
        return $pessoa;
    }
}


try {
    
    $pessoa = GenPessoa::getInstance()->genPessoaByDocumento('Fernando H. Corrêa', new \DocumentoCNPJ('57.595.467/0001-49'));
    
    print_r($pessoa);
    
} catch (RuntimeException $ex) {
    print_r($ex);
} catch (LogicException $ex) {
    print_r($ex);
} catch (Exception $ex) {
    print_r($ex);
} finally {
    print_r(PHP_EOL.'Rollback'.PHP_EOL);
}
